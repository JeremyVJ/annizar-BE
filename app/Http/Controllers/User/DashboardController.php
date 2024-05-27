<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\KabKota;
use App\Models\Konsumen;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return redirect('/');
        $categories =  Kategori::all();
        $featuredProducts = Barang::inRandomOrder()->limit(7)->get();
        $latestProducts = Barang::orderBy('id', 'desc')->limit(6)->get();
        return view('welcome', compact('categories', 'featuredProducts', 'latestProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        $kabkotas = KabKota::orderBy('nama_kabkota', 'ASC')->get();
        $provinces = Provinsi::orderBy('nama_provinsi', 'ASC')->get();
        $data = Konsumen::where('user_id',Auth::user()->id)->first();
        return view('profile', compact('data','kabkotas','provinces'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find(Auth::user()->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'alamat' => 'required',
            'kabkota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required|numeric',
            'no_telepon' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);
        if($request->password == null)
        {
               $password =  $users->password;
        }
        if($request->password != null)
        {
               $password = Hash::make($request->password);
        }
        
        $user = User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password'=> $password
        ]);

        Konsumen::where('user_id',Auth::user()->id)->update([
            'alamat' => $request->alamat,
            'kota' => $request->kabkota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'telepon' => $request->no_telepon,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
