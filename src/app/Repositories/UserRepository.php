<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserRepositoryInterface
{

    public function check()
    {
        return Auth::check();
    }

    public function hasUser()
    {
        return Auth::hasUser();
    }
}
