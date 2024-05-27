<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi =    DB::table('transaksis')
                            ->select('status', DB::raw('COUNT(id) as jumlah'))
                            ->where('status', '=', 'Menunggu Pembayaran')
                            ->groupBy('status')
                            ->first();
        $pembayaran =   DB::table('pembayarans')
                            ->select(DB::raw('COUNT(id) as jumlah, status_bayar'))
                            ->where('status_bayar', '=', 'Menunggu Verifikasi Pembayaran')
                            ->groupBy('status_bayar')
                            ->get();
        return view('admin.dashboard',compact('transaksi','pembayaran'));
    }

     public function profile()
    {
        return view('admin.profile');
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
