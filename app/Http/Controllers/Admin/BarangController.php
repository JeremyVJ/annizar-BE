<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barangList = Barang::with('kategori')->orderBy('id', 'DESC');

        // Cek apakah ada parameter 'nama_barang' dalam request
        if ($request->has('nama_barang')) {
            $nama_barang = $request->input('nama_barang');
            $barangList->where('nama_barang', 'like', '%' . $nama_barang . '%');
        }

        $barangList = $barangList->get();

        return view('admin.barang.index', compact('barangList'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    public function testing()
    {
        $kategoris = Kategori::all();
        return json_encode($kategoris);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'tanggal_masuk' => 'required|date_format:d-m-Y',
            'kategori' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'required|image|max:1024', // Max file size 1MB
        ]);

        $gambarPath = $request->file('gambar')->store('images/barang', 'public');

        Barang::create([
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_masuk' => date('Y-m-d', strtotime($request->input('tanggal_masuk'))),
            'kategori_id' => $request->input('kategori'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'gambar' => $gambarPath,
            'terjual' => '0',
        ]);

        return redirect()->route('admin.barang.index')->with('alert', 1);
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_masuk' => 'required|date|date_format:Y-m-d',
            'kategori' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:1024',
        ]);

        // Find the Barang record by ID
        $barang = Barang::findOrFail($id);

        // Handle the uploaded image file
        $gambarPath = $barang->gambar;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('images/barang', 'public');
        }

        // Update the Barang record
        $barang->update([
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_masuk' => $request->input('tanggal_masuk'),
            'kategori_id' => $request->input('kategori'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'gambar' => $gambarPath,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.barang.index')->with('alert', 'Barang updated successfully');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('alert', 3);
    }
}
