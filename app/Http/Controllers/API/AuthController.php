<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi inputan email dan password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kirim respon error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Mencoba melakukan login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika login berhasil, buat token
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'data' => $token,
                'message' => 'Login berhasil',
            ], 200);
        }

        // Jika login gagal, kirim respon error
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Login gagal. Email atau password salah.',
        ], 401);
    }
}
