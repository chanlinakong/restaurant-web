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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->foreignId('menu_item_id')
                ->constrained('menu_items')
                ->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price',10,2);
            $table->string('notes')->nullable();
            $table->timestamps();
            // Prevent duplicate menu item rows in the same order
            $table->unique(['order_id', 'menu_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
