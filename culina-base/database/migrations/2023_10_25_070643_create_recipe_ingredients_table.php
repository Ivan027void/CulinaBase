<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id('recipe_ingredient_id');
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->decimal('quantity');
            $table->string('size');
            $table->string('note');
            // Define foreign keys for recipe_id and ingredient_id here
            $table->foreign('recipe_id')->references('recipe_id')->on('recipes');
            $table->foreign('ingredient_id')->references('ingredient_id')->on('ingredients');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
