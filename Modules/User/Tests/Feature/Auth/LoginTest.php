<?php

namespace Modules\User\Tests\Feature\Auth;

use Modules\Core\Tests\CoreTestCase;


class LoginTest extends CoreTestCase
{
    public function test_required_validation_works_in_login_api()
    {
        $response = $this->postJson('api/v1/auth/login');
        $response->assertStatus(422);
    }

    public function test_login_api_works()
    {
        $response = $this->postJson('api/v1/auth/login' , [
            'username' => 'admin' ,
            'password' => '123456' ,
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'username' ,
                'first_name' ,
                'last_name' ,
                'access_token' ,
                'expires_in' ,
            ]
        ]);
        $response->assertJson([
            'data' => [
                'username' => 'admin' ,
            ] ,
        ]);
    }

    public function test_login_api_fails_with_wrong_password()
    {
        $response = $this->postJson('api/v1/auth/login' , [
            'username' => 'admin' ,
            'password' => 'wrong-password' ,
        ]);
        $response->assertStatus(401);
    }

    public function test_login_api_fails_with_wrong_username()
    {
        $response = $this->postJson('api/v1/auth/login' , [
            'username' => 'wrong-username' ,
            'password' => '123456' ,
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'data' => [
                'errors' => [
                    'username' ,
                ]
            ]
        ]);
    }
}
