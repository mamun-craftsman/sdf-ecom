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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for variation
            $table->string('product_id'); // Foreign Key to products (Custom String ID)
            $table->json('attributes'); // JSON to store attribute combinations (e.g., {"Size": "Small", "Color": "Red"})
            $table->decimal('price', 10, 2)->nullable(); // Optional price override for this variation
            $table->integer('stock')->default(0); // Stock for this variation
            $table->timestamps(); // Created and Updated timestamps
        
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Foreign Key Constraint
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
