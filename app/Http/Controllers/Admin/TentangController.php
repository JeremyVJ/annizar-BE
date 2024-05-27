<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Informasi::find(1);
        return view('admin.tentang.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show()
    {
        $data = Informasi::find(1);
        return view('admin.tentang.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Informasi::find($id);
        return view('admin.tentang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Informasi::find($id);
        $data->judul = $request->input('judul');
        $data->keterangan = $request->input('keterangan');
        $data->save();

        return redirect()->route('admin.tentang.index');
    }
}
