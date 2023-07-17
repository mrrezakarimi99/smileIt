<?php

namespace Modules\Bank\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Bank\Models\Bank;

class BankFactory extends Factory
{
    protected $model = Bank::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name ,
        ];
    }
}
