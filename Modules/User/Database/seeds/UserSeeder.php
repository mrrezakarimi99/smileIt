<?php

namespace Modules\User\Database\seeds;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'username' => 'admin' ,
        ]);
        User::factory()->count(9)->create();
    }

}
