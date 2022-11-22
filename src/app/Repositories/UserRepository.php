<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserRepositoryInterface
{

    public function check(): bool
    {
        return Auth::check();
    }

    public function hasUser(): bool
    {
        return Auth::hasUser();
    }
}
