<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('admin.produks.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'required',
            'gender' => 'required',
            'usage' => 'required',

            'gambar' => 'required|array',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);

        // simpan produk
        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'gender' => $request->gender,
            'usage' => $request->usage,
        ]);

        // simpan multiple gambar
        if ($request->hasFile('gambar')) {

            foreach ($request->file('gambar') as $file) {

                $path = $file->store(
                    'produk',
                    'public'
                );

                ProdukGambar::create([
                    'produk_id' => $produk->id,
                    'gambar' => $path
                ]);
            }
        }

        return redirect('/dashboard-produk')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produks.update', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'required',
            'gender' => 'required',
            'usage' => 'required',

            'gambar.*' =>
            'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);

        // update data produk
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'gender' => $request->gender,
            'usage' => $request->usage,
        ]);

        // tambah gambar baru
        if ($request->hasFile('gambar')) {

            foreach (
                $request->file('gambar')
                as $file
            ) {

                $path = $file->store(
                    'produk',
                    'public'
                );

                $produk->gambarProduk()
                    ->create([
                        'gambar' => $path
                    ]);
            }
        }

        return redirect('/dashboard-produk')
            ->with(
                'success',
                'Produk berhasil diupdate'
            );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::with(
            'gambarProduk'
        )->findOrFail($id);

        foreach ($produk->gambarProduk as $gambar) {

            if (Storage::disk('public')
                ->exists($gambar->gambar)) {

                Storage::disk('public')
                    ->delete($gambar->gambar);
            }
        }

        $produk->delete();

        return redirect('/dashboard-produk')
            ->with(
                'success',
                'Produk berhasil dihapus'
            );
    }
    public function hapusGambar($id)
    {
        $gambar = ProdukGambar::findOrFail($id);

        // hapus file storage
        if (Storage::disk('public')->exists($gambar->gambar)) {
            Storage::disk('public')->delete($gambar->gambar);
        }

        // hapus data gambar
        $gambar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus'
        ]);
    }
}