<?php

namespace Modules\Bank\Tests\Feature\Bank;

use Illuminate\Support\Str;
use Modules\Account\Models\Account;
use Modules\Bank\Models\Bank;
use Modules\Core\Tests\CoreTestCase;
use Modules\Transaction\Models\Transaction;

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

    public function test_get_bank_by_id_not_found()
    {
        $response = $this->getJson('api/v1/admin/bank/1000' , $this->getAuthHeader());
        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message' ,
            'status'
        ]);

    }

    public function test_create_bank()
    {
        $response = $this->postJson('api/v1/admin/bank' , [
            'name' => Str::random(10)
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

    public function test_update_bank()
    {
        $response = $this->putJson('api/v1/admin/bank/1' , [
            'name' => Str::random(10) ,
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

    public function test_delete_bank()
    {
        $accounts = Account::query()->where('bank_id' , 2)->get();
        foreach ($accounts as $account) {
            Transaction::query()->where('from_account_id' , $account->id)->orWhere('to_account_id' , $account->id)->delete();
            $account->delete();
        }
        $response = $this->deleteJson('api/v1/admin/bank/2' , [] , $this->getAuthHeader());
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

    public function test_delete_bank_with_account()
    {
        $response = $this->deleteJson('api/v1/admin/bank/3' , [] , $this->getAuthHeader());
        $response->assertStatus(403);
        $response->assertJsonStructure([
            'message' ,
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
