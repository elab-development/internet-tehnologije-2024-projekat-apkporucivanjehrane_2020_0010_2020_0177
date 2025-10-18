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
        Schema::create('proizvod_na_menijus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restoran_id')->constrained('restorani')->onDelete('cascade'); // FK ka restorani
            $table->string('name'); // Naziv proizvoda (npr. "Margarita Pizza")
            $table->text('description')->nullable(); // Opis proizvoda
            $table->decimal('price', 8, 2); // Cena proizvoda
            $table->string('image')->nullable(); // Slika proizvoda
            $table->boolean('is_available')->default(true); // Da li je dostupan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proizvod_na_menijus');
    }
};
