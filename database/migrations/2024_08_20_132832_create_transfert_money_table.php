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
        Schema::create('transfert_money', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref_payment');
            $table->string('mode_payment');
            $table->date('date_payment'); 
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfert_money');
    }
};
