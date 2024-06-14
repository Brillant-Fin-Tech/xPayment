<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSitesTable extends Migration
{
    public function up()
    {
        Schema::create('client_sites', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->string('domain')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
