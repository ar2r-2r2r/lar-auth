<?php
namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthService implements AuthServiceInterface {

    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository=$authRepository;
    }
    public function register(Request $request):array
    {
        $user=$this->authRepository->create($request);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $response=[
                'status' => false,
                'message' => 'Email & Password does not match with our record.'
            ];
        }
        $user=$this->authRepository->set($request);
        return $response=[
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ];

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $response=[
            'status'=>true,
            'message'=>'User logout successfully'
        ];
    }
}
