<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Bank\Database\seeds\BankSeeder;
use Modules\User\Database\seeds\UserSeeder;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class ,
            BankSeeder::class ,
        ]);
    }
}
