<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::select('konsumens.*', 'kab_kotas.nama_kabkota', 'provinsis.nama_provinsi', 'users.name','users.email','users.created_at')
                                ->join('users', 'konsumens.user_id', '=', 'users.id')
                                ->join('kab_kotas', 'konsumens.kota', '=', 'kab_kotas.id')
                                ->join('provinsis', 'konsumens.provinsi', '=', 'provinsis.id')
                                ->where('konsumens.id', '!=', '0')
                                ->orderBy('konsumens.id', 'DESC')
                                ->get();

        return view('admin.konsumen.data_konsumen', compact('konsumens'));
    }

    public function store(Request $request)
    {

        // Log request data
        Log::info('Request data: ', $request->all());

        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string',
            'kota' => 'required|integer',
            'provinsi' => 'required|integer',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            // Log validation errors
            Log::error('Validation errors: ', $validator->errors()->toArray());

            return response()->json([
                'status' => 0,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Buat konsumen baru
        $konsumen = Konsumen::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'telepon' => $request->telepon,
        ]);

        // Log successful creation
        Log::info('Konsumen created: ', $konsumen->toArray());

        return response()->json([
            'status' => 1,
            'message' => 'Konsumen berhasil ditambahkan',
            'konsumen' => $konsumen
        ], 201);
    }
}
