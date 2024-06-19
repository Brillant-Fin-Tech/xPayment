<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPayerSitesTable extends Migration
{
    public function up()
    {
        Schema::table('payer_sites', function (Blueprint $table) {
            $table->unsignedBigInteger('payer_id')->nullable();
            $table->foreign('payer_id', 'payer_fk_9881967')->references('id')->on('payers');
            $table->unsignedBigInteger('site_id')->nullable();
            $table->foreign('site_id', 'site_fk_9881968')->references('id')->on('client_sites');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_9881969')->references('id')->on('payment_methods');
        });
    }
}
