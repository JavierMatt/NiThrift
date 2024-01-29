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
        Schema::create('detail_products', function (Blueprint $table) {
            $table->id()->startingValue(101);
            $table->string('name');
            $table->string('users_id');
            $table->string('image');
            $table->integer('size');
            $table->double('price');
            $table->string('condition');
            $table->string('location');
            $table->string('sellerName');
            $table->string('sellerNumber');
            $table->string('category')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_products');
    }
};
