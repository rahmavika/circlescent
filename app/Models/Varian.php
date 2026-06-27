<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'level',
        'ukuran',
        'stok',
        'harga'
    ];

    // varian milik 1 produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}