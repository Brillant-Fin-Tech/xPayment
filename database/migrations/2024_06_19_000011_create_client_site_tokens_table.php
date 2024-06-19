<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSiteTokensTable extends Migration
{
    public function up()
    {
        Schema::create('client_site_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->unique();
            $table->datetime('expires_at');
            $table->string('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
