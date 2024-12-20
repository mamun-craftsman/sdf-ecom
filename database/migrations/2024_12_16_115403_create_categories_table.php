<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Category Title
            $table->string('thumbnail_img')->nullable(); // Thumbnail Image
            $table->unsignedInteger('product_cnt')->default(0); // Count of Products in this Category
            $table->timestamps(); // Created and Updated timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
