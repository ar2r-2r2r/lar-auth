<?php
namespace App\Interfaces;


interface UserServiceInterface{
    public function isAuth();
    public function getName();
    public function getId();
}
