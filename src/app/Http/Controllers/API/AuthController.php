<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\AuthExceptions\EmailAlreadyExistsException;
use App\Exceptions\AuthExceptions\EmailAndPasswordNotMatchException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\AuthServiceInterface;
use Exception;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function createUser(RegisterUserRequest $request)
    {
        try {
            $request->validated();
            $user = $this->authService->register($request);

            return response()->json('User created Successfully!', 201);
        } catch (EmailAlreadyExistsException $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

    public function loginUser(LoginUserRequest $request)
    {
        try {
            $request->validated();
            $response = $this->authService->login($request);

            return response()->json($response, 200);
        } catch (EmailAndPasswordNotMatchException $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request);

            return response()->json('User logout Successfully', 200);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

}
