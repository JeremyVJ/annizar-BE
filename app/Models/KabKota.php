<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;

    public function konsumens()
    {
        return $this->hasMany(Konsumen::class, 'kota');
    }
}
