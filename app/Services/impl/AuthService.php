<?php

namespace App\Services\impl;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\IAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService implements IAuthService
{
    public function login(LoginRequest $request)
    {

        $credentials = $request->validated();
        $token = Auth::attempt($credentials);
        $user = Auth::guard('api')->user();

        if (! $token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials',
            ], 401);
        }
        $refreshToken = JWTAuth::claims([
            'exp' => now()->addDays(30)->timestamp,  // Set expiration for 30 days
            'sub' => $user->id,                    // Optional: use user's email as 'sub'
        ])->fromUser($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful!',
            'user' => $user,
            'data' => [
                'token' => $token,
                'refreshToken' => $refreshToken,
                'type' => 'bearer',
            ],
        ]);
    }

    public function logout()
    {
        auth()->logout(true);

        return response()->json([

        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'data' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function refresh()
    {
        // dd(Auth::user());
        $user = Auth::user();
        $token = Auth::refresh();
        $refreshToken = JWTAuth::claims([
            'exp' => now()->addDays(30)->timestamp,  // Set expiration for 30 days
            'sub' => $user->id,                    // Optional: use user's email as 'sub'
        ])->fromUser($user);

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'data' => [
                'token' => $token,
                'refreshToken' => $refreshToken,
                'type' => 'bearer',
            ],
        ]);
    }

    public function profile()
    {
        $response = auth()->user();

        return UserResource::make($response);
    }
}
