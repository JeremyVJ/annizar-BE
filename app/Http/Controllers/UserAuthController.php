<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserAuthController extends Controller
{
    public function register(Request $request) {

        $validated = $request->validate([
            'nama' => 'required|min:3|max:50',
            'username' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'min:6|required_with:konfirmasi_password|same:konfirmasi_password',
            'konfirmasi_password' => 'min:6'
        ]);
    
        // if (!isset($request->password) || !isset($request->konfirmasi_password) || $request->password != $request->konfirmasi_password) {
        //     return response()->json([
        //         "status" => 0,
        //         "message" => "Password dan Konfirmasi Password Salah"
        //     ], 402);
        // }

        $otpDigits = 4;
        $otp = rand(pow(10, $otpDigits-1), pow(10, $otpDigits)-1);
        $otpExpired = DB::raw("DATE_ADD(NOW(), INTERVAL 15 MINUTE)");

        $user = User::create([
            "name" => $validated['nama'],
            "username" => $validated['username'],
            "email" => $request['email'],
            "password" => Hash::make($validated['password']),
            "role" => "user",
        ]);

        $user->otp = $otp;
        $user->otp_expired = $otpExpired;

        $user->save();

        $getUser = User::where("id", $user['id'])->first();

        //send otp to email;
        $data = [
            'subject' => 'Kode OTP',
            'name' => $validated['nama'],
            'body' => 'Kode OTP Anda adalah ' . $otp . ". Kode ini berlaku hingga " . $getUser->otp_expired,
        ];
       
        Mail::to($validated['email'])->send(new OtpMail($data));

        return response()->json([
            "status" => 1,
            "message" => "Registrasi berhasil. Cek kode OTP pada E-mail terdaftar Anda"
        ]);
        
    }

    public function generateNewOtp(Request $request) {
        if (isset($request->email)) {
            $user = User::where("email", $request->email)->first();

            if ($user != null) {
                $otpDigits = 4;
                $otp = rand(pow(10, $otpDigits-1), pow(10, $otpDigits)-1);
                $otpExpired = DB::raw("DATE_ADD(NOW(), INTERVAL 15 MINUTE)");

                $user->otp = $otp;
                $user->otp_expired = $otpExpired;

                $user->save();

                $user = User::where("email", $request->email)->first();

                //send otp to email;
                $data = [
                    'subject' => 'Kode OTP',
                    'name' => $user->name,
                    'body' => 'Kode OTP Anda adalah ' . $otp . ". Kode ini berlaku hingga " . $user->otp_expired,
                ];
            
                Mail::to($user->email)->send(new OtpMail($data));

                return response()->json([
                    'status' => 1,
                    'message' => 'Email OTP berhasil terkirim!'
                ]);
            }

            return response()->json([
                'status' => 1,
                'message' => 'Email OTP berhasil terkirim!'
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Parameter tidak lengkap!'
        ], 503);
    }

    public function verifyOtp(Request $request) {
        if (isset($request->email) && isset($request->otp)) {            

            $user = User::where("email", $request->email)->first();

            if ($user != null) {

                if (strtotime($user->otp_expired) > strtotime("now")) {

                    if ($user->otp == $request->otp && $user->otp_expired != null) {
                        $user->otp = null;
                        $user->otp_expired = null;
                        $user->save();

                        return response()->json([
                            'status' => 1,
                            'message' => 'Akun berhasil diaktivasi!'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 0,
                            'message' => 'Kode OTP salah!'
                        ], 503);    
                    }
                    
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Waktu OTP sudah habis!'
                    ], 503);
                }
                
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'User tidak ditemukan!'
                ], 503);
            }            
        }

        return response()->json([
            'status' => 0,
            'message' => 'Parameter tidak lengkap!'
        ], 503);

    }

    public function login (Request $request) {
        if (!isset($request->email) || !isset($request->password)) {
            $login = Auth::Attempt($request->all());
            if ($login) {
                $user = Auth::user();

                if ($user->status == 1) {
                    return response()->json([
                        'status' => 1,
                        'message' => 'Login Berhasil',
                        'conntent' => $user
                    ]);
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Akun belum aktif'
                    ], 503);
                }
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Username atau Password Tidak Ditemukan!'
                ], 404);
            }
        }
    }
}
