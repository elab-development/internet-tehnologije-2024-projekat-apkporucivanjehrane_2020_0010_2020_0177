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
        Schema::create('jelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restoran_id')->constrained('restorans')->onDelete('cascade');
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->decimal('cena', 8, 2);
            $table->string('slika')->nullable();
            $table->boolean('dostupno')->default(true);
            $table->string('kategorija_jela')->nullable(); // npr. "Glavno jelo", "Desert", "Piće"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jelos');
    }
};
