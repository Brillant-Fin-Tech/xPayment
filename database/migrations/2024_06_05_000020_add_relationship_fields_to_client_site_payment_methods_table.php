<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientSitePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::table('client_site_payment_methods', function (Blueprint $table) {
            $table->unsignedBigInteger('client_payment_method_id')->nullable();
            $table->foreign('client_payment_method_id', 'client_payment_method_fk_9836803')->references('id')->on('client_payment_methods');
            $table->unsignedBigInteger('client_site_id')->nullable();
            $table->foreign('client_site_id', 'client_site_fk_9836804')->references('id')->on('client_sites');
        });
    }
}
