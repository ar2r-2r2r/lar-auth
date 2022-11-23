<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function create(RegisterUserRequest $request);

    public function set(LoginUserRequest $request);
}
