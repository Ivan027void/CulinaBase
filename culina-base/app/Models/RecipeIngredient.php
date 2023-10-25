<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $table = 'recipe_ingredients'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'recipe_ingredient_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'recipe_id', 'ingredient_id', 'quantity', 'size',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'recipe_id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id', 'ingredient_id');
    }
    
}
