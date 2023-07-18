<?php

namespace Modules\Account\Tests\Feature\Account;

use Modules\Core\Tests\CoreTestCase;

class AccountTest extends CoreTestCase
{
    public function test_get_all_account()
    {
        $response = $this->getJson('api/v1/admin/account' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'account_number' ,
                    'user' ,
                    'bank' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
    }

    public function test_get_all_account_by_user_id()
    {
        $response = $this->getJson('api/v1/admin/account?filter[user_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'account_number' ,
                    'user' ,
                    'bank' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        foreach ($response->json('data') as $account) {
            $this->assertEquals(1 , $account['user']['id']);
        }
    }

    public function test_get_all_account_by_bank_id()
    {
        $response = $this->getJson('api/v1/admin/account?filter[bank_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'account_number' ,
                    'user' ,
                    'bank' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        foreach ($response->json('data') as $account) {
            $this->assertEquals(1 , $account['bank']['id']);
        }
    }

    public function test_get_all_account_by_user_id_and_bank_id()
    {
        $response = $this->getJson('api/v1/admin/account?filter[user_id]=1&filter[bank_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'account_number' ,
                    'user' ,
                    'bank' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);

    }

    public function test_get_account_by_id()
    {
        $response = $this->getJson('api/v1/admin/account/1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'account_number' ,
                'user' ,
                'bank' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_create_account()
    {
        $response = $this->postJson('api/v1/admin/account' , [
            'bank_id' => 1 ,
            'user_id' => 4 ,
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'account_number' ,
                'user' ,
                'bank' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_create_account_with_invalid_bank_id()
    {
        $response = $this->postJson('api/v1/admin/account' , [
            'bank_id' => 100 ,
            'user_id' => 4 ,
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'data' => [
                'errors' => [
                    'bank_id'
                ]
            ] ,
            'status'
        ]);
    }

    public function test_create_account_with_invalid_user_id()
    {
        $response = $this->postJson('api/v1/admin/account' , [
            'bank_id' => 1 ,
            'user_id' => 100 ,
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'data' => [
                'errors' => [
                    'user_id'
                ]
            ] ,
            'status'
        ]);
    }

    public function test_update_account()
    {
        $response = $this->putJson('api/v1/admin/account/1' , [
            'bank_id' => 1 ,
            'user_id' => 4 ,
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'account_number' ,
                'bank' ,
                'user' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);
    }

    public function test_delete_account()
    {
        $response = $this->deleteJson('api/v1/admin/account/1' , [] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'account_number' ,
                'bank' ,
                'user' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);
    }

    public function test_delete_account_with_invalid_id()
    {
        $response = $this->deleteJson('api/v1/admin/account/100' , [] , $this->getAuthHeader());
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message' ,
            'data' ,
            'status'
        ]);
    }

}
