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
        if (!Schema::hasTable('Products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id(); // Auto-incrementing primary key
                $table->string('product_id')->unique(); // Unique product identifier (SKU)
                $table->string('product_name'); // Product name
                $table->integer('qty'); // Quantity (no unique constraint)
                $table->decimal('unitprice', 8, 2); // Unit price with precision
                $table->timestamps(); // Timestamps for created_at and updated_at
            }); 
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Products');
    }
};
