<?php

namespace Modules\Account\Database\seeds;

use Illuminate\Database\Seeder;
use Modules\Account\Models\Account;
use Modules\Bank\Models\Bank;
use Modules\User\Models\User;

class AccountSeeder extends Seeder
{
    public function run()
    {
        Account::factory()->count(10)->make()->each(function ($account , $key) {
            $account->user_id = User::find($key + 1)->id;
            $account->bank_id = Bank::find($key + 1)->id;
            $account->save();
        });
    }
}
