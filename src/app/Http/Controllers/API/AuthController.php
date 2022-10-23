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
    //Create User
    public function createUser(Request $request){
        return AuthService::register($request);

    }
    public function loginUser(Request $request)
    {
        return AuthService::login($request);

    }
}
