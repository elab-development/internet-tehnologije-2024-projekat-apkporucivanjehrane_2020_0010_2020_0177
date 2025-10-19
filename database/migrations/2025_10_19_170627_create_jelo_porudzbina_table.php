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
        Schema::create('jelo_porudzbina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jelo_id')->constrained('jelos')->onDelete('cascade');
            $table->foreignId('porudzbina_id')->constrained('porudzbinas')->onDelete('cascade');
            $table->integer('kolicina')->default(1);
            $table->decimal('cena_stavke', 8, 2); // cena jela u momentu naručivanja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jelo_porudzbina');
    }
};
