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
        Schema::create('business_quizze', function (Blueprint $table) {
            $table->uuid('business_id')->constrained()->onDelete('cascade');
            $table->uuid('quizze_id')->constrained()->onDelete('cascade');
            $table->uuid('exploitation_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_quizze');
    }
    
};
