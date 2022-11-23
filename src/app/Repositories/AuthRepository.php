<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\AuthExceptions\EmailAlreadyExistsException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    public function create(RegisterUserRequest $request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
    }

    public function set(LoginUserRequest $request): User
    {
        return User::where('email', $request->email)->first();
    }

    public function checkEmailAlreadyExists($email)
    {
        if (User::where('email', $email)->exists()) {
            throw new EmailAlreadyExistsException('This email Already exists');
        }
    }
}
