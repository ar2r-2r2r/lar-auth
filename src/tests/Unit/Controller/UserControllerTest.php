<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
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
            'name' => $this->faker->name,
            'email'  => $this->faker->email,
            'password'  => $this->faker->password
        ];

        $this->json('post', 'api/auth/createUser', $user)->assertStatus(Response::HTTP_OK);
    }
}
