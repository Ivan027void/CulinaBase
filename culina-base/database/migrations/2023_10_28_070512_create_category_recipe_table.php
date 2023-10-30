<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('category_recipe', function (Blueprint $table) {
            $table->id(); // This defines the primary key as 'id'
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('recipe_id');
            // Define foreign keys for category_id and recipe_id here
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('recipe_id')->references('recipe_id')->on('recipes');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_recipe');
    }
};
