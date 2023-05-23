<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
