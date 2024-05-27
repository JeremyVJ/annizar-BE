<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BiayaKirim;
use App\Models\Komentar;
use App\Models\Konsumen;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiTmp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('/')->with('alert', 'Anda harus login terlebih dahulu!');
        }

        $productId = $request->query('produk');
        $product = Barang::where('id', $productId)->firstOrFail();
        return view('pembelian.index', compact('product'));
    }

    public function store(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('/')->with('alert', 'Anda harus login terlebih dahulu!');
        }


        // Validate input data
        $validate = $request->validate([
            'jumlah_beli' => 'required|numeric|min:1',
        ], [
            'jumlah_beli.min' => 'Minimal pembelian 1 pcs.',
        ]);

        if (!$validate) {
            return redirect()->back()->with('alert', 'Pembelian gagal! Silakan periksa inputan Anda.');
        }

        $id_barang    = $request->input('id_barang');
        $stok         = $request->input('stok');
        $jumlah_beli  = $request->input('jumlah_beli');
        $jumlah_bayar = $request->input('jumlah_bayar');
        $sisa_stok    = $stok - $jumlah_beli;

        $id_konsumen  = Auth::user()->id;

        // Use the DB facade to execute queries
        try {
            DB::beginTransaction();

            // Insert data into tbl_transaksi_tmp
            DB::table('transaksi_tmps')->insert([
                'konsumen_id' => $id_konsumen,
                'barang_id' => $id_barang,
                'jumlah_beli' => $jumlah_beli,
                'jumlah_bayar' => $jumlah_bayar,
            ]);

            // Update tbl_barang
            DB::table('barangs')
                ->where('id', $id_barang)
                ->update(['stok' => $sisa_stok]);

            DB::commit();

            return redirect()->route('user.pembelian.keranjang')->with('alert', 'Pembelian berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return back()->with('alert', 'Pembelian gagal! Terjadi kesalahan.');
        }
    }

    public function keranjang()
    {
        $transactions = TransaksiTmp::join('barangs as b', 'transaksi_tmps.barang_id', '=', 'b.id')
            ->where('transaksi_tmps.konsumen_id', Auth::user()->id)
            ->get(['transaksi_tmps.*', 'b.gambar', 'b.nama_barang', 'b.harga', 'b.stok']);

        return view('pembelian.keranjang', compact('transactions'));
    }

    public function delete(Request $request)
    {
        $id_konsumen = $request->input('id_konsumen');
        $id_barang = $request->input('id_barang');
        $stok = $request->input('stok');
        $jumlah_beli = $request->input('jumlah_beli');
        $sisa_stok = $stok + $jumlah_beli;

        $query = TransaksiTmp::where('konsumen_id', $id_konsumen)
            ->where('barang_id', $id_barang)
            ->where('jumlah_beli', $jumlah_beli)
            ->delete();

        if ($query) {
            $query1 = Barang::where('id', $id_barang)
                ->update(['stok' => $sisa_stok]);

            if ($query1) {
                return redirect()->route('user.pembelian.keranjang')->with('alert', 2);
            }
        } else {
        }

        // Handle the case when the deletion fails
        return redirect()->route('user.pembelian.keranjang')->with('alert', 'error');
    }

    public function checkout()
    {

        if (Auth::check()) {
            $ppn = 10000;
            $transaksiPenyewaan = TransaksiTmp::with('barang')
                ->where('konsumen_id', Auth::user()->id)->get();

            if ($transaksiPenyewaan->isEmpty()) {
                return redirect()->route('user.dashboard.index')->with('warning', 'No transactions found.');
            }

            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
            \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

            $transactions = TransaksiTmp::join('barangs as b', 'transaksi_tmps.barang_id', '=', 'b.id')
                ->where('transaksi_tmps.konsumen_id', Auth::user()->id)
                ->get(['transaksi_tmps.*', 'b.gambar', 'b.nama_barang', 'b.harga', 'b.stok']);

            $konsumen = Konsumen::where('user_id', Auth::user()->id)->first();

            $ongk = BiayaKirim::where('provinsi_id', $konsumen->provinsi)->where('kab_kota_id', $konsumen->kota)->first();
            $ongkir = $ongk->biaya;

            $trans = Transaksi::create([
                'tanggal_transaksi' => now()->format('Y-m-d H:i:s'),
                'user_id' => Auth::user()->id,
                'total_bayar' => $transaksiPenyewaan->sum('jumlah_bayar') + $ongkir,
                'status' => 'Menunggu Proses Pembayaran'
            ]);
            foreach ($transaksiPenyewaan as $transaksi) {
                $barang = TransaksiDetail::create([
                    'transaksi_id' => $trans->id,
                    'barang_id' => $transaksi->barang_id,
                    'jumlah_beli' => $transaksi->jumlah_beli,
                    'jumlah_bayar' => $transaksi->jumlah_bayar,
                ]);


                TransaksiTmp::where('konsumen_id', $konsumen->user_id)
                    ->where('barang_id', $transaksi->barang_id)
                    ->where('jumlah_beli', $transaksi->jumlah_beli)
                    ->delete();
            }
            $totalAmount = $transaksiPenyewaan->sum('jumlah_bayar');
            $params = [
                'transaction_details' => [
                    'order_id' => $trans->id, // Assuming all transactions have the same order_id
                    'gross_amount' => $totalAmount + $ongkir,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name, // Assuming 'nama_lengkap_user' is a user property
                    'email' => Auth::user()->email,
                    'phone' => $konsumen->telepon,
                ],
            ];

            // TODO
            // $snapToken = \Midtrans\Snap::getSnapToken($params);
            $snapToken = "Dummy";





            return view('pembelian.pembayaran', compact('transaksiPenyewaan', 'snapToken', 'ppn', 'totalAmount', 'ongkir', 'trans', 'konsumen'));
        } else {
            // Handle the case when the user is not authenticated
            return redirect()->route('beranda')->with('warning', 'You must be logged in.');
        }
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVERKEY');
        $hash = \hash('SHA512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hash == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                Transaksi::where('id', $request->order_id)->update([
                    'status' => 'Pembayaran Diterima',
                ]);

                TransaksiTmp::with('barang')
                    ->where('konsumen_id', Auth::user()->id)->delete();
            }
        }
    }

    public function pembayaranberhasil($id)
    {
        try {
            $transaksi = Transaksi::where('id_transaidksi_penyewaan', $id)->first();
            if ($transaksi->id_user != Auth::user()->id_user) {
                toast('Oops', 'success');
                return redirect()->route('user.dashboard.index');
            } else {
                $nomorTelefon = User::where('role', 'admin')->first();
                return \view('Pembayaran diterima', \compact('nomorTelefon', 'transaksi'));
            }
        } catch (\Throwable $th) {
            \abort(404);
        }
    }

    public function transaksi($id)
    {

        $transaksiPenyewaan = TransaksiTmp::with('barang')
            ->where('konsumen_id', Auth::user()->id)->get();
        $trans = Transaksi::wher('id', $id)->update([
            'tanggal_transaksi' => now()->format('d-m-Y H:i:s'),
            'user_id' => Auth::user()->id,
            'total_bayar' => $transaksiPenyewaan->sum('jumlah_bayar'),
            'status' => 'Pembayaran Diterima'
        ]);
        foreach ($transaksiPenyewaan as $transaksi) {
            TransaksiDetail::create([
                'transaksi_id' => $trans->id,
                'barang_id' => $transaksi->barang_id,
                'jumlah_beli' => $transaksi->jumlah_beli,
                'jumlah_bayar' => $transaksi->jumlah_bayar,
            ]);
        }
        TransaksiTmp::with('barang')
            ->where('konsumen_id', Auth::user()->id)->get();

        return redirect()->route('owner.dashboard.index');
    }

    public function komentar(Request $request, $id)
    {
        Komentar::create([
            'tanggal' => now(),
            'barang_id' => $id,
            'konsumen_id' => Auth::user()->id,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back();
    }

    public function riwayat()
    {
        $transactions = Transaksi::with(['konsumen', 'details'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        $detailTransactions = [];

        foreach ($transactions as $transaction) {
            $detailTransactions[$transaction->id] = TransaksiDetail::with(['barang'])
                ->where('transaksi_id', $transaction->id)
                ->get();
        }

        $totalAmount = $detailTransactions[$transaction->id]->sum('jumlah_bayar');

        return view('pembelian.riwayat', compact('transactions', 'detailTransactions','totalAmount'));
    }

   public function deleteRiwayat($id)
{
    $transaksi = Transaksi::where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first(); // Menggunakan first() untuk mengambil satu data transaksi

    if ($transaksi) {
        $transaksiId = $transaksi->id;

        $transaksi->delete();
        $query1 = TransaksiDetail::where('transaksi_id', $transaksiId)
            ->delete();

        if ($query1) {
            return redirect()->route('user.pembelian.riwayat')->with('alert', 2);
        }
    }

    // Handle the case when the deletion fails
    return redirect()->route('user.pembelian.keranjang')->with('alert', 'error');
}



    public function konfirmasi($id)
    {
        Transaksi::where('id', $id)->update([
            'status' => 'Pesanan Selesai',
            'konfirmasi' => 'true'
        ]);

        return redirect()->route('user.terimakasih');
    }

    public function invoice($id = 18)
    {

        if (Auth::check()) {
            $konsumen = Konsumen::where('user_id', Auth::user()->id)->first();
            $transactions = Transaksi::with(['konsumen', 'details'])
                ->where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->orderBy('id', 'DESC')
                ->first();



                $detailTransactions = TransaksiDetail::with(['barang'])
                    ->where('transaksi_id', $transactions->id)
                    ->get();

            return view('pembelian.invoice', compact('konsumen', 'transactions', 'detailTransactions'));
        } else {
            // Handle the case when the user is not authenticated
            return redirect()->route('beranda')->with('warning', 'You must be logged in.');
        }
    }
}
