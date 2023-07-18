<?php

namespace Modules\Account\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\Models\Account;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        $accountNumber = 60379974 . $this->faker->randomNumber(8);
        while (strlen($accountNumber) < 16) {
            $accountNumber .= $this->faker->randomDigit;
        }
        return [
            'account_number' => $accountNumber ,
            'balance'        => 0 ,
        ];
    }
}
