<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService{
    public static function register($request){
        try {
            //validated user
                $validateUser=Validator::make($request->all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique|users,email',
                'password'=>'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validateUser->errors()
                ],401);
            }

            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)

            ]);

            return response()->json([
                'status'=>true,
                'message'=>'User created successfully',
                'token'=>$user->createToken("API TOKEN")->plainTextToken
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }
}