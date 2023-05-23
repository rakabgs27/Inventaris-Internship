<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class ProfileController extends Controller
{
    public function getProfile()
    {
        $message = 'Data User Berhasil Ditambahkan';
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'status' => true,
                'data' => new UserResource($user),
                'message' => $message,
            ], Response::HTTP_OK);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $message = 'Data User Berhasil Diperbarui';
        if (Auth::check()) {
            $user = Auth::user();
            $user->update($request->validated());

            return response()->json([
                'status' => true,
                'data' => new UserResource($user),
                'message' => $message,
            ], Response::HTTP_OK);
        }
    }
}
