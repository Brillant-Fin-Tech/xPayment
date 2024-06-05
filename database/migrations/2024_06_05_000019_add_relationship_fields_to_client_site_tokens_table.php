<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientSiteTokensTable extends Migration
{
    public function up()
    {
        Schema::table('client_site_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('client_site_id')->nullable();
            $table->foreign('client_site_id', 'client_site_fk_9836795')->references('id')->on('client_sites');
        });
    }
}
