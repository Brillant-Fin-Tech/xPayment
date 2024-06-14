<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSitePaymentMethodPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_site_payment_method', function (Blueprint $table) {
            $table->uuid('client_site_id');
            $table->foreign('client_site_id', 'client_site_id_fk_9857568')->references('id')->on('client_sites')->onDelete('cascade');
            $table->uuid('payment_method_id');
            $table->foreign('payment_method_id', 'payment_method_id_fk_9857568')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }
}
