<?php

namespace App\Http\Controllers;

use App\Models\Logstok;
use App\Models\Checkout;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function showPesanan(Request $request)
    {
        $status = $request->get('status', 'pending');

        $checkouts = Checkout::where('status', $status)
            ->latest()
            ->get();

        return view('admin.pesanans.index', compact('checkouts'));
    }

    public function confirm(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->status = 'pending';
        $checkout->catatan_admin = $request->input('catatan_admin');
        $checkout->save();

        if ($request->user()->role === 'admin') {
            return redirect()->route('admin.pesanans.index')
                ->with('success', 'Pesanan berhasil dikonfirmasi.');
        }

        abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini.');
    }
    public function updateStatus(Request $request, $id)
{
    $checkout = Checkout::findOrFail($id);

    $nama = $checkout->nama_pelanggan
        ?? optional($checkout->user)->name
        ?? 'Customer';

    $phone = $checkout->phone
        ?? $checkout->no_hp
        ?? optional($checkout->user)->phone
        ?? null;

    $pengiriman = $checkout->metode_pengiriman;
    $invoice = 'INV-' . str_pad($checkout->id, 5, '0', STR_PAD_LEFT);

    /*
    |--------------------------------------------------------------------------
    | FORMAT PESAN WHATSAPP
    |--------------------------------------------------------------------------
    */

    // STATUS DIPROSES
    if ($request->status == 'diproses') {

        // DELIVERY
        if ($pengiriman == 'delivery') {

            $message =
"*Circle Scent*

Yth. {$nama},

Pesanan Anda telah kami terima dan saat ini sedang diproses oleh tim kami.

📦 *Detail Pesanan*
• No. Pesanan : {$invoice}
• Status : Diproses
• Pengiriman : Delivery Toko

Pesanan akan segera kami siapkan untuk proses pengiriman.

Terima kasih telah berbelanja di Circle Scent.";

        }

        // AMBIL DI TOKO
        else {

            $message =
"*Circle Scent*

Yth. {$nama},

Pesanan Anda telah kami terima dan saat ini sedang diproses oleh tim kami dan dapat diambil nanti di toko.

📦 *Detail Pesanan*
• No. Pesanan : {$invoice}
• Status : Diproses
• Pengiriman : Ambil di Toko

Terima kasih telah berbelanja di Circle Scent.";

        }
    }

    // STATUS DIKIRIM
    elseif ($request->status == 'dikirim') {

        $message =
"*Circle Scent*

Yth. {$nama},

Pesanan Anda saat ini sedang dalam proses pengiriman.

📦 *Detail Pesanan*
• No. Pesanan : {$invoice}
• Status : Dikirim
• Pengiriman : Delivery Toko

Mohon menunggu hingga pesanan diterima.

Terima kasih atas kepercayaan Anda kepada Circle Scent.";

    }

    // STATUS SELESAI
    elseif ($request->status == 'selesai') {

        // DELIVERY
        if ($pengiriman == 'delivery') {

            $message =
"*Circle Scent*

Yth. {$nama},

Pesanan Anda telah selesai dan diterima.

📦 *Detail Pesanan*
• No. Pesanan : {$invoice}
• Status : Selesai
• Pengiriman : Delivery Toko

Terima kasih telah berbelanja dan mempercayai layanan kami.";

        }

        // AMBIL DI TOKO
        else {

            $message =
"*Circle Scent*

Yth. {$nama},

Pesanan Anda telah selesai dan sudah diambil di toko.

📦 *Detail Pesanan*
• No. Pesanan : {$invoice}
• Status : Selesai
• Pengiriman : Ambil di Toko

Terima kasih telah berbelanja dan mempercayai layanan kami.";

        }
    }

    // DEFAULT
    else {

        $message =
"*Circle Scent*

Yth. {$nama},

Status pesanan Anda telah diperbarui.

Terima kasih.";
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS DULU
    |--------------------------------------------------------------------------
    */

    $checkout->status = $request->status;
    $checkout->save();

    /*
    |--------------------------------------------------------------------------
    | JIKA TIDAK ADA NOMOR → LANGSUNG KEMBALI
    |--------------------------------------------------------------------------
    */

    if (!$phone) {

        return back()->with(
            'warning',
            'Status berhasil diperbarui, tetapi customer tidak memiliki nomor WhatsApp.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RAPIIKAN NOMOR
    |--------------------------------------------------------------------------
    */

    $phone = preg_replace('/[^0-9]/', '', $phone);

    if (substr($phone, 0, 1) == '0') {
        $phone = '62' . substr($phone, 1);
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT KE WHATSAPP
    |--------------------------------------------------------------------------
    */

    return redirect()->away(
        "https://wa.me/{$phone}?text=" . urlencode($message)
    );
}

    public function updatePembayaran(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->status_pembayaran = $request->status_pembayaran;
        $checkout->save();

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string',
            'metode_pengiriman' => 'required|in:ditoko,delivery',
            'selected_items' => 'required|array',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $selectedIds = $request->input('selected_items', []);

        if (empty($selectedIds)) {
            return back()->with('error_checkout', 'Tidak ada produk dipilih!');
        }

            $keranjangs = Keranjang::with([
                'produk.gambarProduk',
                'varian'
            ])
            ->where('user_id', $user->id)
            ->whereIn('id', $selectedIds)
            ->get();

        if ($keranjangs->isEmpty()) {
            return back()->with('error_checkout', 'Keranjang kosong!');
        }

        $totalHargaProduk = $keranjangs->sum(fn($k) => $k->jumlah * $k->harga);

        $produkDetails = $keranjangs->map(function ($item) {

            $gambar = null;

            if ($item->produk && $item->produk->gambarProduk->count()) {
                $gambar = $item->produk->gambarProduk->first()->gambar;
            }

            return [
                'produk_id' => $item->produk_id,
                'varian_id' => $item->varian_id,

                'nama'      => optional($item->produk)->nama_produk,
                'gambar'    => $gambar,

                'jumlah'    => $item->jumlah,
                'harga'     => $item->harga,
                'total'     => $item->jumlah * $item->harga,
            ];
        })->toArray();

        $checkout = Checkout::create([
            'user_id' => $user->id,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'metode_pengiriman' => $request->metode_pengiriman,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalHargaProduk,
            'produk_details' => $produkDetails,
            'tanggal_pemesanan' => now(),
            'status_pembayaran' => 'belum_lunas',
            'status' => 'pending',
        ]);

        foreach ($keranjangs as $item) {

            if ($item->varian) {
                $item->varian->decrement('stok', $item->jumlah);
            }

            Logstok::create([
                'tanggal' => now(),
                'produk_id' => $item->produk_id,
                'varian_id' => $item->varian_id, // 🔥 INI WAJIB
                'tipe' => 'keluar',
                'jumlah' => $item->jumlah,
                'keterangan' => 'penjualan',
                'created_by' => $user->id,
            ]);
        }

        Keranjang::whereIn('id', $selectedIds)->delete();

        return redirect()
            ->route('checkout.detail', $checkout->id)
            ->with('success_checkout', 'Checkout berhasil dibuat!');
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $selectedIds = $request->selected_items;

        if (!$selectedIds) {
            return redirect()->route('keranjang.show')
                ->with('error', 'Pilih minimal 1 produk!');
        }

        $keranjangs = Keranjang::with([
            'produk.gambarProduk',
            'varian'
        ])
        ->where('user_id', $user->id)
        ->whereIn('id', $selectedIds)
        ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.show')
                ->with('error', 'Data tidak ditemukan!');
        }

        foreach ($keranjangs as $item) {

            $sisaStok = $item->varian->stok ?? 0;

            if ($item->jumlah > $sisaStok) {
                return redirect()->route('keranjang.show')->with(
                    'error',
                    "Stok {$item->produk->nama_produk} tidak mencukupi. Sisa stok: {$sisaStok}"
                );
            }
        }

        $totalHargaProduk = $keranjangs->sum(fn($k) => $k->jumlah * $k->harga);

        return view('landingpage.pelanggan.checkout', compact('user', 'keranjangs', 'totalHargaProduk'));
    }


    public function detail($id)
    {
        $checkout = Checkout::with('user')->findOrFail($id);
        $produkDetails = $checkout->produk_details ?? [];
        $totalBelanja = collect($produkDetails)->sum(function ($p) {
            return $p['total'];
        });

        return view('landingpage.pelanggan.detailPesanan', [
            'checkout'        => $checkout,
            'produkDetails'   => $produkDetails,
            'totalBelanja'    => $totalBelanja,
            'totalHargaAkhir' => $totalBelanja,
        ]);
    }
    public function detailPaket($id)
    {
        $checkout = Checkout::with('user')
            ->findOrFail($id);

        $produkDetails = $checkout->produk_details ?? [];

        $pdf = Pdf::loadView(
            'admin.pesanans.detailPaket',
            compact('checkout', 'produkDetails')
        );

        $pdf->setPaper([0, 0, 283.46, 425.20], 'portrait');

        return $pdf->stream(
            'label-paket-'.$checkout->id.'.pdf'
        );
    }
    public function cancelAdmin($id)
    {
        $checkout = Checkout::findOrFail($id);

        if ($checkout->status == 'selesai') {
            return back()->with('error', 'Pesanan sudah selesai tidak bisa dibatalkan.');
        }

        $nama = $checkout->nama_pelanggan
            ?? optional($checkout->user)->name
            ?? 'Customer';

        $phone = $checkout->phone
            ?? $checkout->no_hp
            ?? optional($checkout->user)->phone
            ?? null;

        $invoice = 'INV-' . str_pad($checkout->id, 5, '0', STR_PAD_LEFT);

        // 🔥 MESSAGE WHATSAPP
        $message =
    "*Circle Scent*

    Yth. {$nama},

    Mohon maaf, pesanan Anda dengan nomor {$invoice} telah dibatalkan oleh pihak admin.

    Jika ada pertanyaan, silakan hubungi kami kembali.

    Terima kasih.";

        // update status dulu
        $checkout->status = 'dibatalkan';
        $checkout->save();

        // kalau tidak ada nomor WA
        if (!$phone) {
            return back()->with('warning', 'Pesanan dibatalkan, tetapi nomor WhatsApp tidak tersedia.');
        }

        // rapikan nomor
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }

        // redirect WA
        return redirect()->away(
            "https://wa.me/{$phone}?text=" . urlencode($message)
        );
    }
    public function inputResi(Request $request, $id)
    {
        $request->validate([
            'no_resi' => 'required|string|max:100'
        ]);

        $checkout = Checkout::findOrFail($id);
        $checkout->no_resi = $request->no_resi;
        $checkout->tanggal_kirim = now();
        $checkout->status = 'dikirim';
        $checkout->save();

        return back()->with('success', 'Resi berhasil ditambahkan');
    }

}