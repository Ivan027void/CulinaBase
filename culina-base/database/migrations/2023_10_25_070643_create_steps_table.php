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
        Schema::create('steps', function (Blueprint $table) {
            $table->id('step_id');
            $table->unsignedBigInteger('recipe_id');
            $table->integer('step_order');
            $table->text('description');
            // Define foreign key for recipe_id here
            $table->foreign('recipe_id')->references('recipe_id')->on('recipes');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
