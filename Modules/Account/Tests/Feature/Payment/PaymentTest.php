<?php

namespace Modules\Account\Tests\Feature\Payment;

use Modules\Core\Tests\CoreTestCase;

class PaymentTest extends CoreTestCase
{
    public function test_it_can_charge()
    {
        $account = $this->getAccount();
        $response = $this->postJson('api/v1/account/charge' , [
            'amount'         => 1000 ,
            'account_number' => $account['account_number'] ,
            'description'    => 'test charge'
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'account_number' ,
                'user' ,
                'bank' ,
                'created_at' ,
            ]
        ]);
        $balance = $this->convertBalance($account['balance']);
        $this->assertEquals($balance + 1000 , $this->convertBalance($response->json('data.balance')));
    }

    public function test_it_can_not_charge()
    {
        $response = $this->postJson('api/v1/account/charge' , [
            'amount'         => 1000 ,
            'account_number' => '123456789' ,
            'description'    => 'test charge'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'data' => [
                'errors' => [
                    'account_number'
                ]
            ] ,
            'message' ,
            'status'
        ]);
    }

    public function test_it_can_transfer()
    {
        $fromAccount = $this->getAccount();
        $toAccount = $this->getAccount(1);
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => 1000 ,
            'from_account_number' => $fromAccount['account_number'] ,
            'to_account_number'   => $toAccount['account_number'] ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [] ,
            'message' ,
            'status'
        ]);
        $balanceFromAccount = $this->convertBalance($fromAccount['balance']);
        $balanceToAccount = $this->convertBalance($toAccount['balance']);
        $fromAccountNew = $this->getJson('api/v1/admin/account/' . $fromAccount['id'] , $this->getAuthHeader())->json('data');
        $toAccountNew = $this->getJson('api/v1/admin/account/' . $toAccount['id'] , $this->getAuthHeader())->json('data');
        $this->assertEquals($balanceFromAccount - 1000 , $this->convertBalance($fromAccountNew['balance']));
        $this->assertEquals($balanceToAccount + 1000 , $this->convertBalance($toAccountNew['balance']));
    }

    public function test_it_can_transfer_with_invalid_amount()
    {
        $fromAccount = $this->getAccount();
        $toAccount = $this->getAccount(1);
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => 0 ,
            'from_account_number' => $fromAccount['account_number'] ,
            'to_account_number'   => $toAccount['account_number'] ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'amount'
                ]
            ]
        ]);
    }

    public function test_it_can_transfer_with_invalid_from_account_number()
    {
        $fromAccount = $this->getAccount();
        $toAccount = $this->getAccount(1);
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => 1000 ,
            'from_account_number' => '1234567890' ,
            'to_account_number'   => $toAccount['account_number'] ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'from_account_number'
                ]
            ]
        ]);
    }

    public function test_it_can_transfer_with_invalid_to_account_number()
    {
        $fromAccount = $this->getAccount();
        $toAccount = $this->getAccount(1);
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => 1000 ,
            'from_account_number' => $fromAccount['account_number'] ,
            'to_account_number'   => '1234567890' ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'to_account_number'
                ]
            ]
        ]);
    }

    public function test_it_can_transfer_with_not_enough_balance()
    {
        $fromAccount = $this->getAccount();
        $toAccount = $this->getAccount(1);
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => $this->convertBalance($fromAccount['balance']) + 1000 ,
            'from_account_number' => $fromAccount['account_number'] ,
            'to_account_number'   => $toAccount['account_number'] ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => []
        ]);
    }

    public function test_it_can_transfer_with_same_account_number()
    {
        $fromAccount = $this->getAccount();
        $response = $this->postJson('api/v1/account/transfer' , [
            'amount'              => 1000 ,
            'from_account_number' => $fromAccount['account_number'] ,
            'to_account_number'   => $fromAccount['account_number'] ,
            'description'         => 'test transfer'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'to_account_number'
                ]
            ]
        ]);
    }

    public function test_it_can_withdraw()
    {
        $account = $this->getAccount();
        $response = $this->postJson('api/v1/account/withdraw' , [
            'amount'         => 1000 ,
            'account_number' => $account['account_number'] ,
            'description'    => 'test withdraw'
        ] , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'bank' ,
                'user' ,
                'account_number' ,
                'balance' ,
                'created_at' ,
            ] ,
        ]);
        $balance = $this->convertBalance($account['balance']);
        $accountNew = $this->getJson('api/v1/admin/account/' . $account['id'] , $this->getAuthHeader())->json('data');
        $this->assertEquals($balance - 1000 , $this->convertBalance($accountNew['balance']));
    }

    public function test_it_can_withdraw_with_invalid_amount()
    {
        $account = $this->getAccount();
        $response = $this->postJson('api/v1/account/withdraw' , [
            'amount'         => 0 ,
            'account_number' => $account['account_number'] ,
            'description'    => 'test withdraw'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'amount'
                ]
            ]
        ]);
    }

    public function test_it_can_withdraw_with_invalid_account_number()
    {
        $account = $this->getAccount();
        $response = $this->postJson('api/v1/account/withdraw' , [
            'amount'         => 1000 ,
            'account_number' => '1234567890' ,
            'description'    => 'test withdraw'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => [
                'errors' => [
                    'account_number'
                ]
            ]
        ]);
    }

    public function test_it_can_withdraw_with_not_enough_balance()
    {
        $account = $this->getAccount();
        $response = $this->postJson('api/v1/account/withdraw' , [
            'amount'         => $this->convertBalance($account['balance']) + 1000 ,
            'account_number' => $account['account_number'] ,
            'description'    => 'test withdraw'
        ] , $this->getAuthHeader());
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message' ,
            'status' ,
            'data' => []
        ]);
    }

    private function convertBalance($balance): int
    {
        $balance = str_replace(',' , '' , $balance);
        return intval($balance);
    }
}
