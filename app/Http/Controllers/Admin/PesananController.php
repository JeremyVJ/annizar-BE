<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PesananController extends Controller
{
    public function showOrderData()
    {
        $transactions = Transaksi::with(['konsumen', 'details'])
            ->orderBy('id', 'DESC')
            ->get();

        $detailTransactions = [];
        $totals = []; // Initialize an array to hold total for each transaction

        foreach ($transactions as $transaction) {
            $details = DB::table('transaksi_details')
                ->join('barangs', 'transaksi_details.barang_id', '=', 'barangs.id')
                ->select('transaksi_details.*', 'barangs.nama_barang')
                ->where('transaksi_details.transaksi_id', $transaction->id)
                ->get();

            $detailTransactions[$transaction->id] = $details;
            $totals[$transaction->id] = $details->sum('jumlah_beli'); // Store total for each transaction
        }
        return view('admin.pesanan.index', compact('transactions', 'detailTransactions', 'totals'));
    }

    public function konfirm()
    {
        $transactions = Transaksi::with(['konsumen', 'details'])
            ->where('konfirmasi', 'true')
            ->orderBy('id', 'DESC')
            ->get();

        $detailTransactions = [];
        $totals = []; // Initialize an array to hold total for each transaction

        foreach ($transactions as $transaction) {
            $details = DB::table('transaksi_details')
                ->join('barangs', 'transaksi_details.barang_id', '=', 'barangs.id')
                ->select('transaksi_details.*', 'barangs.nama_barang')
                ->where('transaksi_details.transaksi_id', $transaction->id)
                ->get();

            $detailTransactions[$transaction->id] = $details;
            $totals[$transaction->id] = $details->sum('jumlah_beli'); // Store total for each transaction
        }
        // dd($detailTransactions[$transaction->id]->sum('jumlah_beli'));
        return view('admin.pesanan.konfirm', compact('transactions', 'detailTransactions', 'totals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $transaction = Transaksi::findOrFail($id);
        $transaction->status = $request->input('status');
        $transaction->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function showDetail($id)
    {
        $payment = Pembayaran::with(['transaksi.konsumen']) // Assuming you have relationships defined in your models
            ->findOrFail($id);
        dd($payment);
        return view('admin.pesanan.detail', compact('payment'));
    }

    public function kirim($id)
    {
        Transaksi::where('id', $id)->update([
            'status' => 'Pesanan Dikirim',
            'konfirmasi' => 'false'
        ]);

        return redirect()->route('user.terimakasih');
    }

    public function konfirmasi($id)
    {
        Transaksi::where('id', $id)->update([
            'status' => 'Pesanan Diproses',
        ]);

        return redirect()->route('user.terimakasih');
    }
}
