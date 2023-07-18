<?php

namespace Modules\Transaction\Database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions' , function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->float('amount');
            $table->string('description')->nullable();
            $table->enum('type' , ['deposit' , 'withdraw' , 'transfer']);
            $table->unsignedBigInteger('from_account_id')->nullable();
            $table->foreign('from_account_id')->references('id')->on('accounts');
            $table->unsignedBigInteger('to_account_id')->nullable();
            $table->foreign('to_account_id')->references('id')->on('accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
