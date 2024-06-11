<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_category', function (Blueprint $table) {
            $table->uuid('business_id')->constrained()->onDelete('cascade');
            $table->uuid('category_id')->constrained()->onDelete('cascade');
            $table->uuid('exploitation_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_category');
    }
};
