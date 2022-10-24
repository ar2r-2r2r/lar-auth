<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function isAuth()
    {
        if (Auth::check()) {
            $user=Auth::hasUser();
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

    public function getName()
    {
        if(Auth::check()){
            $name=auth()->user()->name;
            return response()->json([
                'status' => true,
                'message' => "$name"
            ], 200);
        }
    }
    public function getId()
    {
        if(Auth::check()){
            $id=auth()->user()->id;
            return response()->json([
                'status' => true,
                'message' => "$id"
            ], 200);
        }
    }



}
