<?php

namespace Modules\Transaction\Tests\Feature\Transaction;

use Modules\Core\Tests\CoreTestCase;

class TransactionTest extends CoreTestCase
{
    public function test_get_all_transaction()
    {
        $response = $this->getJson('api/v1/admin/transaction' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'user' ,
                    'amount' ,
                    'description' ,
                    'type' ,
                    'from' ,
                    'to' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
    }

    public function test_get_all_transaction_by_user_id()
    {
        $response = $this->getJson('api/v1/admin/transaction?filter[user_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'user' ,
                    'amount' ,
                    'description' ,
                    'type' ,
                    'from' ,
                    'to' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);

        foreach ($response->json('data') as $transaction) {
            $this->assertEquals(1 , $transaction['user']['id']);
        }
    }

    public function test_get_all_transaction_by_from_account_id()
    {
        $response = $this->getJson('api/v1/admin/transaction?filter[from_account_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'user' ,
                    'amount' ,
                    'description' ,
                    'type' ,
                    'from' ,
                    'to' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        $account = $this->getJson('api/v1/admin/account/1' , $this->getAuthHeader())->json('data');
        foreach ($response->json('data') as $transaction) {
            $this->assertEquals($account['account_number'] , $transaction['from']);
        }
    }

    public function test_get_all_transaction_by_to_account_id()
    {
        $response = $this->getJson('api/v1/admin/transaction?filter[to_account_id]=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'user' ,
                    'amount' ,
                    'description' ,
                    'type' ,
                    'from' ,
                    'to' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        $account = $this->getJson('api/v1/admin/account/1' , $this->getAuthHeader())->json('data');
        foreach ($response->json('data') as $transaction) {
            $this->assertEquals($account['account_number'] , $transaction['to']);
        }
    }

    public function test_get_all_transaction_by_type()
    {
        $response = $this->getJson('api/v1/admin/transaction?filter[type]=deposit' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'user' ,
                    'amount' ,
                    'description' ,
                    'type' ,
                    'from' ,
                    'to' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        foreach ($response->json('data') as $transaction) {
            $this->assertEquals('deposit' , $transaction['type']);
        }
    }

    public function test_get_transaction_by_id()
    {
        $response = $this->getJson('api/v1/admin/transaction/13' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'user' ,
                'amount' ,
                'description' ,
                'type' ,
                'from' ,
                'to' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);
    }

    public function test_get_transaction_by_id_not_found()
    {
        $response = $this->getJson('api/v1/admin/transaction/1000' , $this->getAuthHeader());
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message' ,
            'status'
        ]);
    }

}
