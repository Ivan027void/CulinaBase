<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeIngredient;

class RecipeIngredientsTableSeeder extends Seeder
{
    public function run()
    {
        // Define the recipe ingredients data
        $recipeIngredients = [
            [
                'recipe_id' => 1,
                'ingredient_id' => 1, // ID of spaghetti in the "ingredients" table
                'quantity' => 250,
                'size' => 'g',
                'note' => null,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2, // ID of pancetta in the "ingredients" table
                'quantity' => 150,
                'size' => 'g',
                'note' => 'potong dadu kecil',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2, // ID of telur in the "ingredients" table
                'quantity' => 2,
                'size' => null,
                'note' => null,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 4, // ID of pamersan in the "ingredients" table
                'quantity' => 50,
                'size' => 'g',
                'note' => 'diparut',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 5, // ID of pecorino romano in the "ingredients" table
                'quantity' => 50,
                'size' => 'g',
                'note' => 'diparut',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 6, // ID of bawang putih in the "ingredients" table
                'quantity' => 2,
                'size' => 'siung',
                'note' => null,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 7, // ID of garam in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => 'secukupnya',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 8, // ID of lada hitam in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => 'secukupnya',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 9, // ID of minyak zaitun in the "ingredients" table
                'quantity' => null,
                'size' => null,
                'note' => null,
            ]
            
        ];

        // Insert the data into the "recipe_ingredients" table
        foreach ($recipeIngredients as $ingredientData) {
            RecipeIngredient::create($ingredientData);
        }
    }
}
//php artisan db:seed --class=RecipeIngredientsTableSeeder
