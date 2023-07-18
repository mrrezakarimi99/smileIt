<?php

namespace Modules\Core\Tests;

use Tests\TestCase;

class CoreTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    protected function getAuthHeader(): array
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
            ] ,
        ]);
        $response->assertJson([
            'data' => [
                'username' => 'admin' ,
            ] ,
        ]);
        $data = $response->json('data');
        $token = $data['access_token'];
        return [
            'Authorization' => 'Bearer ' . $token ,
        ];
    }

    protected function getAccount($number = 0)
    {
        return $this->getJson('api/v1/admin/account' , $this->getAuthHeader())->json('data')[$number];
    }
}
