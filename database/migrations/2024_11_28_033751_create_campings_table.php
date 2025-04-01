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
        Schema::create('campings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('description')->nullable();
            $table->integer('menu_id');
            $table->string('thumb', 255);
            $table->integer('price')->nullable();
            $table->integer('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campings');
    }
};
