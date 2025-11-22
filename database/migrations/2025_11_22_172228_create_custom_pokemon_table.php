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
        Schema::create('custom_pokemon', function (Blueprint $table) {
            $table->id();
            $table->string('origin', 255)->nullable()->default('CUSTOM');
            $table->string('name', 255)->unique();
            $table->string('type', 255);
            $table->text('description')->nullable();
            $table->integer('height');
            $table->integer('weight');
            $table->integer('damage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pokemon');
    }
};
