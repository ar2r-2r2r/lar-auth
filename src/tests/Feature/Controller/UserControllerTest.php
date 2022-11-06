<?php

namespace Tests\Unit;

use App\Http\Controllers\API\LinkController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;


class UserControllerTest extends TestCase
{

    public function test_CRUD_link_model_service()
    {

        //Register user
        $user = [
            'name' => "artur",
            'email'  => "artur@gmail.com",
            'password'  => "artur",
        ];
        $this->json('post', 'api/auth/createUser', $user)->assertStatus(Response::HTTP_CREATED);

        //Login
        $this->get('api/auth/loginUser/?email=artur@gmail.com&password=artur')->assertStatus(Response::HTTP_OK);

        //Create Link
        $link=[
            'userId'=>"1",
            'originalUrl'=>"originalUrl.com",
            'shortCode'=>"qwerty",
            'isPublic'=>"1"
        ];
        $this->json('post', 'api/link/create', $link)->assertStatus(201);

        //Update Link
        $link=[
            'linkId'=>"1",
        ];
        $this->json('put', 'api/link/update', $link)->assertStatus(200);

        //Delete Link
        $link=[
            'userId'=>"1",
            'linkId'=>"1",
        ];
        $this->json('delete', 'api/link/delete', $link)->assertStatus(200);
    }



    public function test_unAthorizedUserCreateLinks()
    {
        $link=[
            'userId'=>"1",
            'originalUrl'=>"originalUrl.com",
            'shortCode'=>"qwerty",
            'isPublic'=>"1"
        ];
        $this->json('post', 'api/link/create', $link)->assertStatus(401);
    }

    public function test_unAthorizedUserUpdateLinks()
    {
        $linkDetails=[
            'linkId'=>"1"
        ];
        $this->json('put', 'api/link/update', $linkDetails)->assertStatus(401);
    }

    public function test_unAthorizedUserDelLinks()
    {
        $link=[
            'userId'=>"1",
            'linkId'=>"1",
        ];
        $this->json('delete', 'api/link/delete', $link)->assertStatus(401);
    }

}
