<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService=$authService;
    }

    public function createUser(RegisterUserRequest $request){
        try{
            $request->validated();
            $user=$this->authService->register($request);
            return response()->json($user, 201);
        }catch (\Exception $exception){
            return response()->json($exception, 500);
        }

    }

    public function loginUser(LoginUserRequest $request)
    {
        try{
            $request->validated();
            $response=$this->authService->login($request);
            return response()->json($response,200);
        }catch (\Exception $exception){
            return response()->json($exception, 500);
        }

    }

    public function logout(Request $request)
    {
        try {
            $response=$this->authService->logout($request);
            return response()->json($response,200);
        }catch (\Exception $exception) {
            return response()->json($exception, 500);
        }

    }

}
