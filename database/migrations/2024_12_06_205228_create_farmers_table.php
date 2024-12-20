<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->string('id')->primary(); // Custom Primary Key (e.g., nameMobile_Number)
            $table->string('name'); // Farmer's Name
            $table->string('mobile_number')->unique(); // Unique Mobile Number
            $table->string('division')->nullable(); // Division (nullable)
            $table->string('district')->nullable(); // District (nullable)
            $table->string('sub_district')->nullable(); // Sub-district (nullable)
            $table->string('address')->nullable(); // Address (nullable)
            $table->string('nid')->nullable(); // National ID (nullable)
            $table->json('assets')->nullable(); // Farmer's Assets (example what he can supply)
            $table->boolean('is_verified')->default(false); // Verification Status
            $table->string('password'); // Password for authentication
            $table->decimal('payable', 10, 2)->default(0.00)->nullable(); // Amount payable to the farmer
            $table->decimal('due', 10, 2)->default(0.00)->nullable(); // Outstanding balance
            $table->string('image')->nullable(); // Farmer's Image
            $table->rememberToken(); // Token for "Remember Me" functionality
            $table->timestamps(); // Created and Updated timestamps
            $table->softDeletes(); // Soft delete column
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('farmers');
    }
}
