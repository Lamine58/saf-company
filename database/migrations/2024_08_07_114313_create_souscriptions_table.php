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
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('customer_id', 36);
            $table->string('number_souscriptions');
            $table->string('formule');
            $table->string('file_souscriptions');
            $table->date('date_of_expiration'); 
            $table->timestamps();
        });

        Schema::table('souscriptions', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souscriptions');
    }
};
