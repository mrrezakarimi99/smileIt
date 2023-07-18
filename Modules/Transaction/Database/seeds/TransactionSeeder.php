<?php

namespace Modules\Transaction\Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Account\Models\Account;
use Modules\Account\Repositories\AccountRepository;
use Modules\Transaction\Models\Transaction;
use Modules\User\Models\User;

class TransactionSeeder extends Seeder
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id == 1) {
                Transaction::factory()->count(1)->create([
                    'to_account_id' => $user->accounts->first()->id ,
                    'user_id'       => $user->id ,
                    'type'          => 'deposit' ,
                    'amount'        => 100000
                ]);
            }else{
                Transaction::factory()->count(10)->create([
                    'to_account_id' => $user->accounts->first()->id ,
                    'user_id'       => $user->id
                ]);
                $transaction = Transaction::factory()->make();
                $transaction->type = 'transfer';
                $transaction->user_id = $user->id;
                $transaction->to_account_id = $user->accounts->first()->id;
                $transaction->from_account_id = Account::query()->where('user_id' , 1)->first()->id;
                $transaction->save();
            }
            $balances = $this->accountRepository->generateBalance();
            foreach ($balances as $balance) {
                Account::query()->where('id' , $balance->account_id)->update([
                    'balance' => $balance->balance
                ]);
            }
        }

    }
}
