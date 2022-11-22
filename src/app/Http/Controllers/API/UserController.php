<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserServiceInterface;

class UserController extends Controller
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function isAuth(): bool
    {
        return $this->userService->isAuthenticated();
    }

    public function getName(): string
    {
        return $this->userService->getName();
    }

    public function getId(): int|string
    {
        return $this->userService->getId();
    }


}
