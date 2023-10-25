<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'ingredient_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'ingredient_name',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredient_id', 'recipe_id')
            ->withPivot('quantity', 'size');
    }

}
