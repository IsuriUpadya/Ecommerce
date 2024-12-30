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
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('ecommerce_users')->onDelete('cascade');
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamps();
    
                // Add foreign key constraint
                $table->foreign('user_id')->references('id')->on('ecommerce_users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
