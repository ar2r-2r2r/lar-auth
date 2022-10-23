<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $service)
    {
        $this->authService=$service;
    }

    //Create User
    public function createUser(Request $request){
        return $this->authService->register($request);

    }
    public function loginUser(Request $request)
    {
//        return AuthService::login($request);
        return $this->authService->login($request);

    }
}
