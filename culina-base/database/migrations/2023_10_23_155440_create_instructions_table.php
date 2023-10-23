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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('recipe_id'); // Foreign Key to Recipe
            $table->integer('step_number'); // The order of the instruction step
            $table->text('description'); // The cooking instruction for the step
            $table->timestamps(); // Created at and updated at timestamps

            // Define the foreign key constraint to the Recipe table
            $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
