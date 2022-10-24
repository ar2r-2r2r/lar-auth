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

    public function __construct(AuthServiceInterface $service)
    {
        $this->authService=$service;
    }

    //Create User
    public function createUser(Request $request){
        return $this->authService->register($request);

    }
    public function loginUser(Request $request)
    {
        return $this->authService->login($request);
    }
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }



}
