<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;


class UserControllerTest extends TestCase
{

    public function test_CRUD_link_model_service()
    {

        //Register user
        $user = [
            'name' => "artur",
            'email' => "artur@gmail.com",
            'password' => "artur",
        ];
        $this->json('post', 'api/auth/createUser', $user)
            ->assertStatus(Response::HTTP_CREATED);

        //Login
        $this->get('api/auth/loginUser/?email=artur@gmail.com&password=artur')
            ->assertStatus(Response::HTTP_OK);

        //Create Link
        $link = [
            'userId' => "1",
            'originalUrl' => "originalUrl.com",
            'shortCode' => "qwerty",
            'isPublic' => "1",
        ];
        $this->json('post', 'api/link/create', $link)->assertStatus(201);

        //Update Link
        $link = [
            'linkId' => "1",
        ];
        $this->json('put', 'api/link/update', $link)->assertStatus(200);

        //Delete Link
        $link = [
            'userId' => "1",
            'linkId' => "1",
        ];
        $this->json('delete', 'api/link/delete', $link)->assertStatus(200);
    }


}
