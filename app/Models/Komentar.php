<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang_id',
        'konsumen_id',
        'komentar',
        'tanggal'
    ];

    /**
     * Get the user that owns the Komentar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konsumen_id', 'id');
    }
}
