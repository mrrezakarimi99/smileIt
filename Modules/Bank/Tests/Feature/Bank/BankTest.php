<?php

namespace Modules\User\Tests\Feature\Auth;

use Modules\Core\Tests\CoreTestCase;

class BankTest extends CoreTestCase
{
    public function test_get_all_bank()
    {
        $response = $this->getJson('api/v1/admin/bank' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'name' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);

    }

    public function test_get_bank_by_id()
    {
        $response = $this->getJson('api/v1/admin/bank/1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_create_bank()
    {
        $response = $this->postJson('api/v1/admin/bank' , [
            'name' => 'Bank Test' ,
        ] , $this->getAuthHeader());
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_update_bank()
    {
        $response = $this->putJson('api/v1/admin/bank/1' , [
            'name' => 'Bank Test' ,
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_delete_bank()
    {
        $response = $this->deleteJson('api/v1/admin/bank/1' , [] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_get_bank_by_id_not_found()
    {
        $response = $this->getJson('api/v1/admin/bank/1000' , $this->getAuthHeader());
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message' ,
            'status'
        ]);

    }

    public function test_create_bank_validation()
    {
        $response = $this->postJson('api/v1/admin/bank' , [
            'name' => '' ,
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'data' => [
                'errors' => [
                    'name'
                ]
            ] ,
            'status'
        ]);
    }

    public function test_update_bank_validation()
    {
        $response = $this->putJson('api/v1/admin/bank/1' , [
            'name' => '' ,
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'data' => [
                'errors' => [
                    'name'
                ]
            ] ,
            'status'
        ]);
    }

    public function test_delete_bank_validation()
    {
        $response = $this->deleteJson('api/v1/admin/bank/1000' , [] , $this->getAuthHeader());
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message' ,
            'data' ,
            'status'
        ]);
    }

}
