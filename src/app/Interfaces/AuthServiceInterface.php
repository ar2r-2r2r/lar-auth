<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function register(RegisterUserRequest $request);

    public function login(LoginUserRequest $request);

    public function logout(Request $request);
}
