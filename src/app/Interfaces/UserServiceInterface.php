<?php
namespace App\Interfaces;


interface UserServiceInterface{
    public function isAuthJS();
    public function getNameJS();
    public function getIdJS();

    public function isAuthenticated():bool;
    public function getName():string;
    public function getId():string|int;
}
