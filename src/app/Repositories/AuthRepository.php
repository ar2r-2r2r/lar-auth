<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface{

    public function create(Request $request)
    {
        return User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)

        ]);
    }
    public function set(Request $request)
    {
        return User::where('email', $request->email)->first();
    }
}
