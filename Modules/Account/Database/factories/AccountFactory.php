<?php

namespace Modules\Account\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\Models\Account;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'account_number' => 60379974 . $this->faker->unique()->randomNumber(8) ,
            'balance'        => 0
        ];
    }
}
