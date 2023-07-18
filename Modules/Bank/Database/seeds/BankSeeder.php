<?php

namespace Modules\Bank\Database\seeds;

use Illuminate\Database\Seeder;
use Modules\Bank\Models\Bank;

class BankSeeder extends Seeder
{
    public function run()
    {
        Bank::factory()->count(10)->create();
    }
}
