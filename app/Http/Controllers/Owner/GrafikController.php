<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function index()
    {
        $tahun = '';
        $years = Transaksi::distinct()->orderBy('tanggal_transaksi')->pluck('tanggal_transaksi')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y');
        })->toArray();
    
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah = Transaksi::whereYear('tanggal_transaksi', $tahun)
                ->whereMonth('tanggal_transaksi', $i)
                ->with('details')
                ->get()
                ->sum(function ($transaksi) {
                    return $transaksi->details->sum('jumlah_beli');
                });
        
            $data[] = $jumlah ?: 0;
        }        
    
        return view('admin.grafik.index', compact('tahun', 'data', 'years'));
    }

    public function show(Request $request)
    {
        $tahun = $request->input('tahun');
        // dd($tahun);
        $years = Transaksi::distinct()->orderBy('tanggal_transaksi')->pluck('tanggal_transaksi')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y');
        })->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlah = Transaksi::whereYear('tanggal_transaksi', $tahun)
                ->whereMonth('tanggal_transaksi', $i)
                ->with('details')
                ->get()
                ->sum(function ($transaksi) {
                    return $transaksi->details->sum('jumlah_beli');
                });
        
            $data[] = $jumlah ?: 0;
        }
        return view('admin.grafik.index', compact('tahun', 'data', 'years'));
    }

}
