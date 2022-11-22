<?php
declare(strict_types=1);

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function check();

    public function hasUser();
}
