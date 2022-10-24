<?php
namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;


class UserService implements UserServiceInterface {

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->userRepository=$repository;
    }
    public function isAuthJS()
    {
        if ($this->userRepository->check()) {
            $user=$this->userRepository->hasUser();
            return response()->json([
                'status' => true,
                'message' => "$user"
            ], 200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'not auth'
            ], 200);
        }
    }

    public function getNameJS()
    {
        if($this->userRepository->check()){
            $name=auth()->user()->name;
            return response()->json([
                'status' => true,
                'message' => "$name"
            ], 200);
        }
    }
    public function getIdJS()
    {
        if($this->userRepository->check()){
            $id=auth()->user()->id;
            return response()->json([
                'status' => true,
                'message' => "$id"
            ], 200);
        }
    }

    public function isAuthenticated(): bool
    {
        if ($this->userRepository->check()) {

            return true;
        }
        else{
            return false;
        }
    }

    public function getName(): string
    {
        if($this->userRepository->check()){
            return auth()->user()->name;
        }
        else return "cant check the user";
    }

    public function getId(): string|int
    {
        if($this->userRepository->check()){
            return auth()->user()->id;
        }
        else return "cant check the user";

    }
}
