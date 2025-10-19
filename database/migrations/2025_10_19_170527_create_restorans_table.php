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
        Schema::create('restorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategorija_id')->constrained('kategorijas')->onDelete('cascade');
            $table->string('naziv');
            $table->string('slug')->unique();
            $table->text('opis')->nullable();
            $table->string('adresa');
            $table->string('telefon')->nullable();
            $table->string('slika')->nullable();
            $table->decimal('cena_dostave', 8, 2)->default(0);
            $table->integer('vreme_dostave')->default(30); // u minutima
            $table->decimal('ocena', 3, 2)->default(0);
            $table->boolean('aktivan')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restorans');
    }
};
