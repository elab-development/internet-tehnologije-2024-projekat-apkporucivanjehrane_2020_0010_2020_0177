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
        Schema::create('restorani', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // FK ka categories
            $table->string('name'); // Naziv restorana
            $table->string('slug')->unique(); // URL-friendly naziv
            $table->text('description')->nullable(); // Opis restorana
            $table->string('address'); // Adresa
            $table->string('phone')->nullable(); // Telefon
            $table->string('image')->nullable(); // Slika restorana
            $table->decimal('delivery_price', 8, 2)->default(0); // Cena dostave
            $table->integer('delivery_time')->default(30); // Vreme dostave u minutima
            $table->boolean('is_active')->default(true); // Da li je restoran aktivan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restorani');
    }
};
