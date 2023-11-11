<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients'; // Correct the table name
    protected $primaryKey = 'ingredient_id';

    protected $fillable = [
        'recipe_id',
        'ingredient_name',
        'quantity',
        'size',
        'note',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class,  'recipe_id');
    }
}
