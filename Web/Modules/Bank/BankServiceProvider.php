<?php

namespace Modules\Bank;

use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
    }
}
