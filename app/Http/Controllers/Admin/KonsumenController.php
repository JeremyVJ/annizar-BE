<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::select('konsumens.*', 'kab_kotas.nama_kabkota', 'provinsis.nama_provinsi', 'users.name','users.email','users.created_at')
                                ->join('users', 'konsumens.user_id', '=', 'users.id')
                                ->join('kab_kotas', 'konsumens.kota', '=', 'kab_kotas.id')
                                ->join('provinsis', 'konsumens.provinsi', '=', 'provinsis.id')
                                ->where('konsumens.id', '!=', '0')
                                ->orderBy('konsumens.id', 'DESC')
                                ->get();

        return view('admin.konsumen.data_konsumen', compact('konsumens'));
    }
}
