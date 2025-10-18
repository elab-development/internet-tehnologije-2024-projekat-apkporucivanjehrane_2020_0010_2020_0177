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
        Schema::table('restorani', function (Blueprint $table) {
            // Dodavanje indeksa za ubrzanje pretraga
            $table->index('name'); // Indeks na name kolonu za brže pretraživanje
            $table->index('is_active'); // Indeks na is_active za filtriranje aktivnih restorana
            $table->index(['category_id', 'is_active']); // Kompozitni indeks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restorani', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['category_id', 'is_active']);
        });
    }
};
