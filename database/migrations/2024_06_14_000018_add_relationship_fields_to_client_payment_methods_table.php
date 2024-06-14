<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientPaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::table('client_payment_methods', function (Blueprint $table) {
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9830780')->references('id')->on('clients');
            $table->uuid('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_9830781')->references('id')->on('payment_methods');
        });
    }
}
