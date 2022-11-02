<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService=$authService;
    }

    public function createUser(RegisterUserRequest $request){
        $request->validated();
        $response=$this->authService->register($request);
        return response()->json($response);
    }

    public function loginUser(LoginUserRequest $request)
    {
        $request->validated();
        $response=$this->authService->login($request);
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $response=$this->authService->logout($request);
        return response()->json($response);
    }



}
