<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function createUser(Request $request){
        $response=$this->authService->register($request);
        $statusCode=array_pop($response);
        return response()->json($response,$statusCode);
    }

    public function loginUser(Request $request)
    {
        $response=$this->authService->login($request);
        $statusCode=array_pop($response);
        return response()->json($response,$statusCode);
    }

    public function logout(Request $request)
    {
        $response=$this->authService->logout($request);
        $statusCode=array_pop($response);
        return response()->json($response,$statusCode);
    }



}
