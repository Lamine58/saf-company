<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('indicator');
            $table->text('definition')->nullable();
            $table->string('type');
            $table->longtext('data')->nullable();
            $table->uuid('user_id');
            $table->uuid('categorie_id');
            $table->uuid('method_id');
            $table->uuid('unity_id');
            $table->uuid('periodicity_id');
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreign('unity_id')->references('id')->on('unities')->onDelete('cascade');
            $table->foreign('periodicity_id')->references('id')->on('periodicities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};
