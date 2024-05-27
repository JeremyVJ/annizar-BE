<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $years = DB::table('transaksis')
            ->select(DB::raw('EXTRACT(YEAR FROM tanggal_transaksi) as tahun'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM tanggal_transaksi)'))
            ->get()
            ->pluck('tahun');

        return view('owner.laporan.index', compact('years'));
    }

    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $years = DB::table('transaksis')
            ->select(DB::raw('EXTRACT(YEAR FROM tanggal_transaksi) as tahun'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM tanggal_transaksi)'))
            ->get()
            ->pluck('tahun');
            $query = DB::table('transaksi_details as a')
            ->join('transaksis as b', 'a.transaksi_id', '=', 'b.id')
            ->join('barangs as c', 'a.barang_id', '=', 'c.id')
            ->select(
                'a.transaksi_id as detail_transaksi_id',
                'a.barang_id as detail_barang_id',
                'a.jumlah_beli',
                'b.id as transaksi_id',
                'b.tanggal_transaksi',
                'b.total_bayar',
                'b.status',
                'c.id as barang_id',
                'c.nama_barang',
                'c.harga'
            )
            ->whereMonth('b.tanggal_transaksi', $bulan)
            ->whereYear('b.tanggal_transaksi', $tahun)
            ->groupBy('c.nama_barang', 'detail_transaksi_id', 'detail_barang_id', 'jumlah_beli', 'tanggal_transaksi', 'total_bayar', 'status', 'harga', 'b.id', 'c.id')
            ->orderBy('detail_transaksi_id', 'ASC')
            ->get();

        // Calculate total_jumlah_beli and total_seluruh
        $total_jumlah_beli = $query->sum('jumlah_beli');

        $total_seluruh = DB::table('transaksi_details as a')
            ->join('transaksis as b', 'a.transaksi_id', '=', 'b.id')
            ->join('barangs as c', 'a.barang_id', '=', 'c.id')
            ->whereMonth('b.tanggal_transaksi', $bulan)
            ->whereYear('b.tanggal_transaksi', $tahun)
            ->sum(DB::raw('c.harga * a.jumlah_beli'));

        $data = [
            'query' => $query,
            'total_jumlah_beli' => $total_jumlah_beli,
            'total_seluruh' => $total_seluruh,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('owner.laporan.cetak', compact('data','query'));
    }
}
