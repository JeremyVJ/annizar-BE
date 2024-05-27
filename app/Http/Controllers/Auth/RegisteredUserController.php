<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\KabKota;
use App\Models\Konsumen;
use App\Models\Provinsi;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $kabkotas = KabKota::orderBy('nama_kabkota', 'ASC')->get();
    $provinces = Provinsi::orderBy('nama_provinsi', 'ASC')->get();
        return view('auth.register',compact('kabkotas','provinces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'alamat' => 'required',
            'kabkota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required|numeric',
            'no_telepon' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required',  Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Konsumen::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'kota' => $request->kabkota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'telepon' => $request->no_telepon,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
