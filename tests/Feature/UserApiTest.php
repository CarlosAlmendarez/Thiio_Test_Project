<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class UserApiTest extends TestCase
{
    public function test_register(): void
    {
        Artisan::call('migrate');

        //verify the view
        $loadView = $this->get(route('signup'));
        $loadView->assertStatus(200);

        //varify bad register data
        $badRegister = $this->post(route('api/register'),["email"=>"aaa","password"=>"123"]);
        $badRegister->assertStatus(302);

        //varify good register data
        $goodRegister = $this->post(route('api/register'),["name"=>"exmple","email"=>"a@b.com","password"=>"123456789","password_confirmation"=>"123456789"]);
        $goodRegister->assertStatus(200);
    }

    public function test_login(): void
    { 
        Artisan::call('migrate');

        //verify the view
        $loadView = $this->get(route('login'));
        $loadView->assertStatus(200);

        //verify bad register data
        $badLogin = $this->post(route('api/login'),["email"=>"aaa","password"=>"123"]);
        $badLogin->assertStatus(302);

        //verify good register with not found
        $loginNotFound = $this->post(route('api/login'),["email"=>"a@b.com","password"=>"123456789"]);
        $loginNotFound->assertStatus(302);

        //verify good login
        $goodLogin = $this->post(route('api/register'),["name"=>"exmple","email"=>"a@b.com","password"=>"123456789","password_confirmation"=>"123456789"]);
        $goodLogin = $this->post(route('api/login'),["email"=>"a@b.com","password"=>"123456789"]);
        $goodLogin->assertStatus(200);
        $goodLogin->assertJsonStructure(['token']);
    }

    public function test_logout(): void
    { 
        Artisan::call('migrate');

        //verify good logout
        $goodLogout = $this->post(route('api/register'),["name"=>"exmple","email"=>"a@b.com","password"=>"123456789","password_confirmation"=>"123456789"]);
        $goodLogout = $this->post(route('api/login'),["email"=>"a@b.com","password"=>"123456789"]);
        $goodLogout->assertJsonStructure(['token']);
        $token = $goodLogout->json('token');
        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->get(route('api/logout'));
        $logoutResponse->assertStatus(200);
    }

    public function test_update(): void
    { 
        Artisan::call('migrate');

        //verify good update
        $goodUpdate = $this->post(route('api/register'),["name"=>"exmple","email"=>"a@b.com","password"=>"123456789","password_confirmation"=>"123456789"]);
        $goodUpdate = $this->post(route('api/login'),["email"=>"a@b.com","password"=>"123456789"]);
        $goodUpdate->assertJsonStructure(['token']);
        $token = $goodUpdate->json('token');
        $updateResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->post(route('api/update'),["id"=>"1","name"=>"newName","email"=>"newemail@b.com"]);
        $updateResponse->assertStatus(200);
    }

    public function test_delete(): void
    { 
        Artisan::call('migrate');

        //verify good delete
        $goodDelete = $this->post(route('api/register'),["name"=>"exmple","email"=>"a@b.com","password"=>"123456789","password_confirmation"=>"123456789"]);
        $goodDelete = $this->post(route('api/login'),["email"=>"a@b.com","password"=>"123456789"]);
        $goodDelete->assertJsonStructure(['token']);
        $token = $goodDelete->json('token');
        $deleteResponse = $this->withHeader('Authorization', 'Bearer ' . $token)->post(route('api/delete'),["id"=>"1"]);
        $deleteResponse->assertStatus(200);
    }
}
