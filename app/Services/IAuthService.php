<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

interface IAuthService
{
    public function login(LoginRequest $request);

    public function logout();

    public function register(Request $request);

    public function refresh();

    public function profile();
}
