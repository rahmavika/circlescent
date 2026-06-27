<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogStok;
use Carbon\Carbon;

class LogStokController extends Controller
{
    /**
     * TAMPILKAN LOG STOK
     */
    public function index(Request $request)
    {
        $query = LogStok::with([
            'produk',
            'user',
            'varian'
        ])->orderBy('created_at', 'desc');

        // Filter tanggal
        if ($request->from && $request->to) {
            $query->whereBetween('tanggal', [
                $request->from,
                $request->to
            ]);
        }

        $logStok = $query->get();

        return view('admin.logstoks.index', compact('logStok'));
    }
}