<?php

namespace App\Http\Controllers\Admin;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Informasi::find(2);
        return view('admin.cara.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Get the data from the database based on the ID
         // Assuming the ID to fetch is always 1 as per the original code
        $data = Informasi::find($id);

        return view('admin.cara.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        // Validate the form data
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
        ]);

        // Get the data from the request
        $judul = $request->input('judul');
        $keterangan = $request->input('keterangan');

        // Update the data in the database
        $data = Informasi::find($id);
        $data->judul = $judul;
        $data->keterangan = $keterangan;
        $data->save();

        return redirect()->route('admin.cara.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
