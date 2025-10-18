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
        Schema::create('porudzbina_proizvod', function (Blueprint $table) {
            $table->id();
            $table->foreignId('porudzbina_id')->constrained('porudzbine')->onDelete('cascade'); // FK ka porudzbine
            $table->foreignId('proizvod_na_meniju_id')->constrained('proizvod_na_menijus')->onDelete('cascade'); // FK ka proizvod_na_menijus
            $table->integer('quantity'); // Količina proizvoda
            $table->decimal('price', 8, 2); // Cena proizvoda u trenutku poručivanja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbina_proizvod');
    }
};
