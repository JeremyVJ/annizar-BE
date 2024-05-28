<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

// codingan lama
// class KategoriController extends Controller
// {
//     public function index()
//     {
//         $kategoris = Kategori::orderBy('id', 'DESC')->get();

//         return view('admin.kategori.index', compact('kategoris'));
//     }

//     public function create()
//     {
//         return view('admin.kategori.input');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'nama_kategori' => 'required',
//         ]);

//         Kategori::create([
//             'nama_kategori' => $request->nama_kategori
//         ]);

//         return redirect()->route('admin.kategori.index')->with('alert', 1);
//     }

//     public function edit($id)
//     {
//         $data = Kategori::findOrFail($id);
//         return view('admin.kategori.edit', compact('data'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'nama_kategori' => 'required',
//         ]);

//         $kategori = Kategori::findOrFail($id);
//         $kategori->update([
//             'nama_kategori' => $request->nama_kategori
//         ]);

//         return redirect()->route('admin.kategori.index')->with('alert', 2);
//     }

//     public function destroy(Kategori $kategori)
//     {
//         // Delete the Kategori and its related Barangs
//         $kategori->barang()->delete();
//         $kategori->delete();

//         return redirect()->route('admin.kategori.index')->with('success', 'Kategori has been deleted successfully.');
//     }

// }

// codingan baru
class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('id', 'DESC')->get();
        return response()->json($kategoris);
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json($kategori, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json($kategori);
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Kategori has been deleted successfully.']);
    }
}