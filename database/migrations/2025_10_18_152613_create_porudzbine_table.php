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
        Schema::create('porudzbine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK ka users
            $table->foreignId('restoran_id')->constrained('restorani')->onDelete('cascade'); // FK ka restorani
            $table->string('order_number')->unique(); // Jedinstveni broj porudžbine
            $table->decimal('total_price', 10, 2); // Ukupna cena
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'on_delivery', 'delivered', 'cancelled'])->default('pending'); // Status
            $table->string('delivery_address'); // Adresa dostave
            $table->text('note')->nullable(); // Napomena za porudžbinu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbine');
    }
};
