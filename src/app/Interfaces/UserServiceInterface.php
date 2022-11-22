<?php
declare(strict_types=1);

namespace App\Interfaces;


interface UserServiceInterface
{
    public function isAuthenticated(): bool;

    public function getName(): string;

    public function getId(): string|int;
}
