<?php

namespace Modules\Example\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Example\Models\Example;

class ExampleFactory extends Factory
{
    protected $model = Example::class;

    public function definition(): array
    {
        return [
            'item' => "Value" ,
        ];
    }
}
