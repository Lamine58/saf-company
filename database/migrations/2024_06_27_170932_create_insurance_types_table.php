<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('insurance_id');
            $table->string('name');
            $table->string('care_network');
            $table->string('newsletter');
            $table->string('file_description');
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->longtext('formules')->nullable();
            $table->longtext('conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance_types');
    }
};
