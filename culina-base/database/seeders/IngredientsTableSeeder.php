<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ingredients = [
            ['ingredient_name' => 'spaghetti'],
            ['ingredient_name' => 'pancetta'],
            ['ingredient_name' => 'telur'],
            ['ingredient_name' => 'parmesan'],
            ['ingredient_name' => 'pecorino romano'],
            ['ingredient_name' => 'bawang putih,'],
            ['ingredient_name' => 'Garam'],
            ['ingredient_name' => 'lada hitam'],
            ['ingredient_name' => 'minyak zaitun extra virgin'],

           
        ];

        // Insert the data into the "ingredients" table
        foreach ($ingredients as $ingredientData) {
            Ingredient::create($ingredientData);
        }
    }
}

//php artisan db:seed --class=IngredientsTableSeeder
