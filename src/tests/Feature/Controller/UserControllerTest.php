<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_createUser()
    {
        $user = [
            'name' => "artur",
            'email'  => "artur@gmail.com",
            'password'  => "artur",
        ];

        $this->json('post', 'api/auth/createUser', $user)->assertStatus(Response::HTTP_OK);
    }

    public function test_loginUser()
    {
        $this->get('api/auth/loginUser/?email=artur@gmail.com&password=artur')->assertStatus(Response::HTTP_OK);
    }

    public function test_unAthorizedResponse()
    {
        $linkDetails=[
            'originalUrl'=>"mylinkoriginal.com",
            'isPublic'=>"1",
        ];
        $this->json('post', 'api/link/create', $linkDetails)->assertStatus(401);
    }
}
