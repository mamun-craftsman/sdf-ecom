<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary(); // Custom Primary Key (e.g., day-month-year-FarmerID)
            $table->string('name'); // Product Name
            $table->string('category_id')->nullable(); // Foreign Key to Category Table (String)
            $table->string('title')->nullable(); // Product Title
            $table->decimal('mrp_price', 10, 2)->nullable(); // Maximum Retail Price
            $table->decimal('whole_sale_price', 10, 2)->nullable(); // Wholesale Price
            $table->decimal('producer_price', 10, 2)->nullable(); // Price set by Farmer
            $table->text('short_description')->nullable(); // Brief Description
            $table->longText('long_description')->nullable(); // Detailed Description
            $table->string('farmer_id'); // Foreign Key to Farmer Table (String)
            $table->boolean('is_approved')->default(false); // Approval Status
            $table->string('approved_by')->nullable(); // SubAdmin ID who approved (String)
            $table->string('agent_id')->nullable(); // Agent who got the product (String)
            $table->string('hubpoint_id')->nullable(); // Hubpoint storing this product (String)
            $table->json('contents')->nullable(); // Multiple Images stored as JSON
            $table->string('thumbnail_image'); // Thumbnail Image (Not Null)
            $table->integer('estimated_stock')->default(0); // Estimated Stock Count
            $table->integer('stock')->default(0); // Actual Stock Count
            $table->string('unit_type')->nullable(); // Unit Type (kg, pieces, gm, L, etc.)
            $table->string('origin_from')->nullable(); // Origin of the Product
            $table->timestamps(); // Created and Updated timestamps
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
