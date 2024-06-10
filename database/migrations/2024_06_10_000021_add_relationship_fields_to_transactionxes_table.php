<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionxesTable extends Migration
{
    public function up()
    {
        Schema::table('transactionxes', function (Blueprint $table) {
            $table->unsignedBigInteger('payer_id')->nullable();
            $table->foreign('payer_id', 'payer_fk_9856670')->references('id')->on('payers');
        });
    }
}
