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
        
        Schema::create('collections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('admin_id')->nullable();
            $table->uuid('business_id');
            $table->uuid('value_chain_id');
            $table->uuid('category_id');
            $table->string('state');
            $table->string('location');
            $table->datetime('date');

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('value_chain_id')->references('id')->on('value_chains');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};

