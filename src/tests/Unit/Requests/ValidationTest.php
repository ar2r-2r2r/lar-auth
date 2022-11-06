<?php

namespace Tests\Unit;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_contains_valid_rules_CreateLink()
    {
        $r=new CreateLinkRequest();
        $this->assertEquals([
            'originalUrl' => 'required|unique:links',
            'isPublic'=>'required',
        ], $r->rules());
    }

    public function test_it_contains_valid_rules_GetOriginalLink()
    {
        $r=new GetOriginalLinkRequest();
        $this->assertEquals([
            'shortCode' => 'required'
        ], $r->rules());
    }

    public function test_it_contains_valid_rules_GetUserLink()
    {
        $r=new GetUserLinksRequest();
        $this->assertEquals([
            'userId' => 'required',
        ], $r->rules());
    }

    public function test_it_contains_valid_rules_LoginUser()
    {
        $r=new LoginUserRequest();
        $this->assertEquals([
            'email' => 'required',
            'password'=>'required'
        ], $r->rules());
    }

    public function test_it_contains_valid_rules_RegisterUser()
    {
        $r=new RegisterUserRequest();
        $this->assertEquals([
            'name' => 'required',
            'email'=>'required',
            'password'=>'required'
        ], $r->rules());
    }

    public function test_it_contains_valid_rules_UpdateDelLink()
    {
        $r=new UpdateDelLinkRequest();
        $this->assertEquals([
            'linkId' => 'required'
        ], $r->rules());
    }

}
