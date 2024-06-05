<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->decimal('amount', 15, 2)->nullable();
            $table->float('commission_rate', 5, 2)->nullable();
            $table->decimal('commission', 15, 2)->nullable();
            $table->decimal('amount_net', 15, 2)->nullable();
            $table->datetime('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
