<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface UserRepositoryInterface{
    public function check();
    public function hasUser();
}
