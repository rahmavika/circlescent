<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Varian;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjangs = Keranjang::with([
            'produk.gambarProduk',
            'varian'
        ])->where('user_id', Auth::id())->get();
        $totalHarga = $keranjangs->sum(function ($keranjang) {
            return $keranjang->jumlah * $keranjang->harga;
        });
        return view('landingpage.pelanggan.keranjang', compact('keranjangs', 'totalHarga'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'varian_id' => 'required|exists:varians,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $varian = Varian::findOrFail($request->varian_id);

        $userId = Auth::id();
        $jumlah = $request->jumlah;

        $keranjang = Keranjang::where('user_id', $userId)
            ->where('varian_id', $varian->id)
            ->first();

        if ($keranjang) {

            $keranjang->jumlah += $jumlah;
            $keranjang->save();

        } else {

            Keranjang::create([
                'user_id' => $userId,
                'produk_id' => $varian->produk_id,
                'varian_id' => $varian->id,
                'jumlah' => $jumlah,
                'harga' => $varian->harga,
            ]);

        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $keranjangs = Keranjang::with([
            'produk.gambarProduk',
            'varian'
        ])
        ->where('user_id', Auth::id())
        ->get();

        return view('landingpage.pelanggan.keranjang', compact('keranjangs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $stokTersedia = $keranjang->varian->stok ?? 0;

        if ($request->action === 'increase') {
            if ($keranjang->jumlah < $stokTersedia) {
                $keranjang->jumlah++;
            }
        } elseif ($request->action === 'decrease') {
            if ($keranjang->jumlah > 1) {
                $keranjang->jumlah--;
            }
        }

        $keranjang->save();

        return back()->with('Jumlah produk diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Keranjang::where('id', $id)->where('user_id', Auth::id())->delete();
       $keranjangs = Keranjang::with([
            'produk.gambarProduk',
            'varian'
        ])->where('user_id', Auth::id())->get();
       session()->put('keranjangs', $keranjangs);
       return redirect()->back()->with('Produk berhasil dihapus dari keranjang.');
   }
}