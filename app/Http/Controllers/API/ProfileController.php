<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Get the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika sudah login, dapatkan data profil pengguna
            $user = Auth::user();

            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'Get Profil sukses',
            ], 200);
        }

        // Jika pengguna belum login, kirim respon error
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Data Kosong',
        ], 401);
    }

    public function updateProfile(Request $request)
    {
        // Validasi inputan profil yang diubah
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Jika validasi gagal, kirim respon error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika sudah login, dapatkan data user
            $user = Auth::user();

            // Update data profil user
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'status' => true,
                'data' => $user->id,
                'message' => 'Profil berhasil diperbarui',
            ], 200);
        }

        // Jika pengguna belum login, kirim respon error
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Pengguna belum login',
        ], 401);
    }
}
