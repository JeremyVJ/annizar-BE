<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_transaksi','user_id','total_bayar','status']; 

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'user_id', 'user_id');
    }
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
