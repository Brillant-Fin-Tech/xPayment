<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayersTable extends Migration
{
    public function up()
    {
        Schema::create('payers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('sumsub_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
