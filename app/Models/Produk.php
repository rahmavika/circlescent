<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'gambar',
        'gender',
        'usage'
    ];

    // 1 produk punya banyak varian
    public function varians()
    {
        return $this->hasMany(Varian::class, 'produk_id');
    }
    public function gambarProduk()
    {
        return $this->hasMany(ProdukGambar::class, 'produk_id');
    }
}