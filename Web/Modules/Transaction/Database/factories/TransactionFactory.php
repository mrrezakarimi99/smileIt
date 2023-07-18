<?php

namespace Modules\Transaction\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Transaction\Models\Transaction;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['deposit' , 'withdraw']);
        return [
            'description' => $this->faker->sentence ,
            'type'        => $type ,
            'amount'      => $type == 'withdraw' ?
                $this->faker->numberBetween(100 , 999) :
                $this->faker->numberBetween(1000 , 9999) ,
        ];
    }
}
