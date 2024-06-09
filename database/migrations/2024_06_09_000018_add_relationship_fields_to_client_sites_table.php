<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientSitesTable extends Migration
{
    public function up()
    {
        Schema::table('client_sites', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9836785')->references('id')->on('clients');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_9856779')->references('id')->on('payment_methods');
        });
    }
}
