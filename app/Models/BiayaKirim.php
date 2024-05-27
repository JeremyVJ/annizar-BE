<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaKirim extends Model
{
    use HasFactory;
    protected $fillable = [
        'provinsi',
        'kabkota',
        'biaya'
    ];

    public function provinsis()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id'); // Replace 'Provinsi' with your actual model name for Provinsi
    }

    // Define the relationship with KabKota
    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'kab_kota_id'); // Replace 'KabKota' with your actual model name for KabKota
    }
}
