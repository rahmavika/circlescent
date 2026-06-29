<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Halaman semua produk + search
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $produks = Produk::with([
            'varians',
            'gambarProduk'
        ]);

        if ($search) {
            $produks->where(function ($query) use ($search) {

                // cari nama produk
                $query->where('nama_produk', 'like', "%{$search}%")

                    // cari harga di tabel varians
                    ->orWhereHas('varians', function ($q) use ($search) {
                        $q->where('harga', 'like', "%{$search}%");
                    });
            });
        }

        $produks = $produks
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('landingpage.page.semuaproduk', [
            'produks' => $produks,
        ]);
    }

    /**
     * Produk terbaru (limit 10)
     */
    public function terbaru()
    {
        $produks = Produk::with(['varians', 'produkGambars'])
            ->latest()
            ->take(10)
            ->get();

        return view('landingpage.page.terbaru', [
            'produks' => $produks,
        ]);
    }

    /**
     * Search terpisah (pakai pagination)
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::with([
            'varians',
            'gambarProduk',
        ])
        ->when($search, function ($query, $search) {

            return $query->where(function ($q) use ($search) {

                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhereHas('varians', function ($varian) use ($search) {
                        $varian->where('harga', 'like', "%{$search}%");
                    });
            });
        })
        ->latest()
        ->paginate(10);

        return view('landingpage.page.semuaproduk', [
            'produks' => $produks,
        ]);
    }
    public function detail($id)
    {
        $produk = Produk::with([
            'gambarProduk',
            'varians'
        ])->findOrFail($id);

        $relatedProduk = Produk::with('gambarProduk')
            ->where('id', '!=', $id)
            ->latest()
            ->take(8)
            ->get();

        return view('landingpage.page.detailproduk', compact(
            'produk',
            'relatedProduk'
        ));
    }
    public function semuaproduk(Request $request)
    {
        $search = $request->get('search');
        $gender = $request->get('gender');

        $produks = Produk::with([
            'varians',
            'gambarProduk'
        ]);

        // filter gender
        if (!empty($gender)) {
            $produks->whereRaw('LOWER(gender) = ?', [strtolower($gender)]);
        }

        // search nama produk / harga varian
        if (!empty($search)) {
            $produks->where(function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhereHas('varians', function ($q) use ($search) {
                        $q->where('harga', 'like', "%{$search}%");
                    });
            });
        }

        $produks = $produks->latest()->get();

        return view('landingpage.page.semuaproduk', [
            'produks' => $produks,
        ]);
    }
}