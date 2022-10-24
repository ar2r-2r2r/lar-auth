<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $service)
    {
        $this->userService=$service;
    }
    public function isAuth()
    {
        return $this->userService->isAuthJS();
    }

    public function getName()
    {
        return $this->userService->getNameJS();
    }
    public function getId()
    {
        return $this->userService->getIdJS();
    }



}
