<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;


class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function isAuthenticated(): bool
    {
        return $this->userRepository->check();
    }

    public function getName(): string
    {
        if ($this->userRepository->check()) {
            return auth()->user()->name;
        } else {
            return "cant check the user";
        }
    }

    public function getId(): string|int
    {
        if ($this->userRepository->check()) {
            return auth()->user()->id;
        } else {
            return "cant check the user";
        }

    }
}
