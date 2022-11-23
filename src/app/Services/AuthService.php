<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthExceptions\EmailAndPasswordNotMatchException;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthService implements AuthServiceInterface
{

    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterUserRequest $request)
    {

        $this->authRepository->checkEmailAlreadyExists($request->email);
        $user = $this->authRepository->create($request);
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new EmailAndPasswordNotMatchException("Email & Password does not match with our record");
        }
        $user = $this->authRepository->set($request);

        return $user;

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
