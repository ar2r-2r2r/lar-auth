<?php
namespace App\Interfaces;


interface UserServiceInterface{
    public function isAuthenticated():bool;
    public function getName():string;
    public function getId():string|int;
}
