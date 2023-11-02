<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    public function run()
    {
        // Define the recipe ingredients data
        $ingredients = [
            [
                'recipe_id' => 1,
                'ingredient_name' => 'spaghetti', // ID of spaghetti in the "ingredients" table
                'quantity' => '250',
                'size' => 'g',
                'note' => null,
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'pancetta', // ID of pancetta in the "ingredients" table
                'quantity' => '150',
                'size' => 'g',
                'note' => 'potong dadu kecil',
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'telur', // ID of telur in the "ingredients" table
                'quantity' => '2',
                'size' => null,
                'note' => null,
            ],
            [
                'recipe_id' => '1',
                'ingredient_name' => 'pamersan', // ID of pamersan in the "ingredients" table
                'quantity' => 50,
                'size' => 'g',
                'note' => 'diparut',
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'pecorino romano', // ID of pecorino romano in the "ingredients" table
                'quantity' => '50',
                'size' => 'g',
                'note' => 'diparut',
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'bawang putih', // ID of bawang putih in the "ingredients" table
                'quantity' => '2',
                'size' => 'siung',
                'note' => null,
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'garam', // ID of garam in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => 'secukupnya',
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'lada hitam', // ID of lada hitam in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => 'secukupnya',
            ],
            [
                'recipe_id' => 1,
                'ingredient_name' => 'minyak zaitun', // ID of minyak zaitun in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => 'extra virgin',
            ]
            
        ];

        // Insert the data into the "ingredients" table
        foreach ($ingredients as $ingredientData) {
            Ingredient::create($ingredientData);
        }
    }
}
//php artisan db:seed --class=RecipeIngredientsTableSeeder
