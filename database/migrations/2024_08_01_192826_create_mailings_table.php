<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mailings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longtext('recipient');
            $table->longtext('cc')->nullable(); 
            $table->longtext('bcc')->nullable(); 
            $table->string('subject');
            $table->longtext('message');
            $table->uuid('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mailings');
    }
};
