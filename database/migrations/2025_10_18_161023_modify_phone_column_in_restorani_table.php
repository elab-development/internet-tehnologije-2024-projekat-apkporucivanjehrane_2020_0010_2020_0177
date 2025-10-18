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
            // Izmena kolone phone da bude unique
            $table->string('phone', 20)->nullable()->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restorani', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
        });
    }
};
