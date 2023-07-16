<?php

namespace Modules\User\Database\seeds;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(10)->create();
    }

}
