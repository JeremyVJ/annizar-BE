<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Feedback;
use App\Models\Kategori;
use App\Models\Informasi;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function tentangKami()
    {
        $data = Informasi::find(1); // Assuming 'id_informasi' column is the primary key
        return view('tentang', compact('data'));
    }

    public function caraPembelian()
    {
        $data = Informasi::find(2); // Assuming 'id_informasi' column is the primary key
        return view('cara_pembelian', compact('data'));
    }

    public function feedback(Request $request)
    {
        Feedback::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with(['success' => 'Pesan berhasil dikirimkan']);
    }

    public function search(Request $request)
    {
        $categories =  Kategori::all();
        $featuredProducts = Barang::inRandomOrder()->limit(7)->get();
        $searchQuery = $request->input('search');
        // dd($searchQuery);
        $barangs = Barang::where('nama_barang', 'like', '%' . $searchQuery . '%')->get();

        return view('search', ['barangs' => $barangs,'categories' => $categories , 'featuredProducts' => $featuredProducts]);
    }
}
