<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionxesTable extends Migration
{
    public function up()
    {
        Schema::table('transactionxes', function (Blueprint $table) {
            $table->uuid('payer_id')->nullable();
            $table->foreign('payer_id', 'payer_fk_9856670')->references('id')->on('payers');
            $table->uuid('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_9870903')->references('id')->on('payment_methods');
            $table->uuid('site_id')->nullable();
            $table->foreign('site_id', 'site_fk_9870904')->references('id')->on('client_sites');
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9870905')->references('id')->on('clients');
        });
    }
}
