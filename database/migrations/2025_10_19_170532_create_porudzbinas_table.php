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
        Schema::create('porudzbinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('restoran_id')->constrained('restorans')->onDelete('cascade');
            $table->string('ime_kupca');
            $table->string('email_kupca');
            $table->string('telefon_kupca');
            $table->string('adresa_dostave');
            $table->decimal('ukupna_cena', 10, 2);
            $table->enum('status', ['nova', 'u_pripremi', 'na_putu', 'dostavljena', 'otkazana'])->default('nova');
            $table->text('napomena')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbinas');
    }
};
