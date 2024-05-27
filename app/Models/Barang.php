<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'tanggal_masuk',
        'kategori_id',
        'harga',
        'stok',
        'gambar',
        'terjual',
    ];

    protected $dates = [
        'tanggal_masuk',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
