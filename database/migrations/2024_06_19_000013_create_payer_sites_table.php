<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayerSitesTable extends Migration
{
    public function up()
    {
        Schema::create('payer_sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code');
            $table->string('wallet_address')->nullable();
            $table->string('base_currency_code')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('customer_kyc')->nullable();
            $table->string('external_customer')->nullable();
            $table->string('response_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
