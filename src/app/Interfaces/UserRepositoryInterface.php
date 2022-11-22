<?php
declare(strict_types=1);

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function check():bool;

    public function hasUser():bool;
}
