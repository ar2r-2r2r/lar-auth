<?php
namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService implements AuthServiceInterface {

    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->authRepository=$repository;
    }
    public function register(Request $request):array
    {

        try {
                $validateUser=Validator::make($request->all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required'
            ]);

            if($validateUser->fails()){
                return $response=[
                    'status'=>'false',
                    'message'=>'validation error',
                    'errors'=>$validateUser->errors(),
                    'statusCode'=>401,
                    ];
            }

            $user=$this->authRepository->create($request);

            return $response=[
                'status'=>true,
                'message'=>'User created successfully',
                'token'=>$user->createToken("API TOKEN")->plainTextToken,
                'statusCode'=>200,
            ];
        } catch (\Throwable $th) {
            return $response=[
                'status'=>false,
                'message'=>$th->getMessage(),
                'statusCode'=>500,
            ];
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return $response=[
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                    'statusCode'=>401,
                ];
            }

            if(!Auth::attempt($request->only(['email', 'password']))){

                return $response=[
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                    'statusCode'=>401,
                ];
            }

//            $user = User::where('email', $request->email)->first();
            $user=$this->authRepository->set($request);

            return $response=[
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'statusCode'=>200,
            ];

        } catch (\Throwable $th) {
            return $response=[
                'status' => false,
                'message' => $th->getMessage(),
                'statusCode'=>500,
            ];
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $response=[
            'status'=>true,
            'message'=>'User logout successfully',
            'statusCode'=>200,
        ];
    }
}
