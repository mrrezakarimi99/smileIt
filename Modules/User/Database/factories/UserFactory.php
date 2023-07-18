<?php

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName() ,
            'last_name'  => $this->faker->lastName() ,
            'username'   => $this->faker->userName() ,
            'password'   => '123456' ,
        ];
    }
}
