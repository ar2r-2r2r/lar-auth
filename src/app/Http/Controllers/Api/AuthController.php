<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        AuthService::register($request);
    }
    public function loginUser(Request $request)
    {
        AuthService::login($request);
    }
    
}
