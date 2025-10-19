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
        Schema::table('restorans', function (Blueprint $table) {
            $table->index('kategorija_id');
            $table->index('naziv');
            $table->index('aktivan');
        });

        Schema::table('jelos', function (Blueprint $table) {
            $table->index('restoran_id');
            $table->index('dostupno');
        });

        Schema::table('porudzbinas', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('restoran_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restorans', function (Blueprint $table) {
            $table->dropIndex(['kategorija_id']);
            $table->dropIndex(['naziv']);
            $table->dropIndex(['aktivan']);
        });

        Schema::table('jelos', function (Blueprint $table) {
            $table->dropIndex(['restoran_id']);
            $table->dropIndex(['dostupno']);
        });

        Schema::table('porudzbinas', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['restoran_id']);
            $table->dropIndex(['status']);
        });
    }
};
