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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('recipe_id');
            $table->string('recipe_name');
            $table->string('gambar')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('preparation_time');
            $table->string('cooking_time');
            // Define foreign key for category_id here
            $table->foreign('author_id')->references('id')->on('users');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
