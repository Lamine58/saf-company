<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('region_id')->index();
            $table->uuid('departement_id')->index();
            $table->uuid('sous_prefecture_id')->index();
            $table->uuid('filiere_id')->index();
            $table->string('localite')->index();
            $table->string('logo')->nullable();
            $table->string('legal_name');
            $table->string('phone');
            $table->string('location');
            $table->string('email')->unique();
            $table->uuid('user_id')->index();
            $table->string('name_of_operator');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->timestamps();
        });

        Schema::table('businesses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
