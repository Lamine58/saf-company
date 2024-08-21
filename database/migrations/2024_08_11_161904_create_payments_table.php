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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('customer_id', 36);
            $table->char('souscription_id', 36);
            $table->string('ref_payment');
            $table->string('mode_payment');
            $table->date('date_payment'); 
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('souscription_id')->references('id')->on('souscriptions')->onDelete('cascade');

        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
