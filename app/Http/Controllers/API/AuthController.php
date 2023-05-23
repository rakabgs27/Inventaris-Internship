<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $messageBerhasil = 'Login berhasil';
        $messageGagal = 'Login gagal. Email atau password salah';

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                ],
                'message' => $messageBerhasil,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'data' => null,
            'message' => $messageGagal,
        ], 401);
    }
}
