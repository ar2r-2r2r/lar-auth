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

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService=$userService;
    }
    public function isAuth()
    {
        return $this->userService->isAuthenticated();
    }

    public function getName()
    {
        return $this->userService->getName();
    }
    public function getId()
    {
        return $this->userService->getId();
    }



}
