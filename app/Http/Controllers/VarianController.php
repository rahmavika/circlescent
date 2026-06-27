<?php

namespace App\Http\Controllers;

use App\Models\Varian;
use App\Models\Produk;
use App\Models\Logstok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $varians = Varian::all();
        return view('admin.varians.index', compact('varians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.varians.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'level' => 'nullable|in:Exclusive,Premium,VIP,VVIP',
            'ukuran' => 'required|in:30ml,50ml,100ml',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        // Simpan varian
        $varian = Varian::create([
            'produk_id' => $validated['produk_id'],
            'level' => $validated['level'],
            'ukuran' => $validated['ukuran'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
        ]);

        // Simpan log stok otomatis
        if ($validated['stok'] > 0) {
            LogStok::create([
                'produk_id'  => $validated['produk_id'],
                'varian_id'  => $varian->id,
                'tipe'       => 'masuk',
                'jumlah'     => $validated['stok'],
                'tanggal'    => now()->toDateString(),
                'keterangan' => 'Stok awal varian',
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()
            ->route('dashboard-varian.index')
            ->with('pesan', 'Varian berhasil ditambahkan!');
    }

    public function tambah(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $varian = Varian::with('produk')->findOrFail($id);

        // tambah stok
        $varian->stok += $request->jumlah;
        $varian->save();

        // simpan log
        LogStok::create([
            'produk_id'  => $varian->produk_id,
            'varian_id'  => $varian->id,
            'tipe'       => 'masuk',
            'jumlah'     => $request->jumlah,
            'tanggal'    => now()->toDateString(),
            'keterangan' => 'Tambah stok',
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Stok berhasil ditambahkan');
    }
    public function kurangi(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string'
        ]);

        $varian = Varian::with('produk')->findOrFail($id);

        if ($request->jumlah > $varian->stok) {
            return back()->with(
                'error',
                'Stok tidak mencukupi'
            );
        }

        // kurangi stok
        $varian->stok -= $request->jumlah;
        $varian->save();

        // simpan log
        LogStok::create([
            'produk_id'  => $varian->produk_id,
            'varian_id'  => $varian->id,
            'tipe'       => 'keluar',
            'jumlah'     => $request->jumlah,
            'tanggal'    => now()->toDateString(),
            'keterangan' => $request->keterangan,
            'created_by' => Auth::id(),
        ]);

        return back()->with(
            'success',
            'Stok berhasil dikurangi'
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(Varian $varians)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Varian $dashboard_varian)
    {
        $produks = Produk::all();

        return view('admin.varians.update', [
            'varian' => $dashboard_varian,
            'produks' => $produks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Varian $dashboard_varian)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'level' => 'nullable|in:Exclusive,Premium,VIP,VVIP',
            'ukuran' => 'required|in:30ml,50ml,100ml',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        // stok lama
        $stokLama = $dashboard_varian->stok;

        // stok baru
        $stokBaru = $validated['stok'];

        // update data varian
        $dashboard_varian->update($validated);

        // cek apakah stok berubah
        if ($stokBaru != $stokLama) {

            // hitung selisih
            $selisih = abs($stokBaru - $stokLama);

            // tentukan tipe log
            $tipe = $stokBaru > $stokLama
                ? 'masuk'
                : 'keluar';

            LogStok::create([
                'produk_id'  => $dashboard_varian->produk_id,
                'varian_id'  => $dashboard_varian->id,
                'tipe'       => $tipe,
                'jumlah'     => $selisih,
                'tanggal'    => now()->toDateString(),
                'keterangan' => 'Perubahan stok dari edit varian',
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()
            ->route('dashboard-varian.index')
            ->with('pesan', 'Varian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $varian = Varian::findOrFail($id);

        $varian->delete();

        return redirect()
            ->route('dashboard-varian.index')
            ->with('pesan', 'Data varian berhasil dihapus');
    }
}