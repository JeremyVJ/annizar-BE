<?php

namespace App\Http\Controllers;

use App\Models\KabKota;
use Illuminate\Http\Request;

class KabupatenKotaController extends Controller
{
    public function getKabkotaByProvinsi(Request $request)
    {
        $provinsiId = $request->input('provinsi_id');
        $kabkotas = KabKota::where('provinsi_id', $provinsiId)->orderBy('nama_kabkota', 'ASC')->get();

        return response()->json($kabkotas);
    }
}
