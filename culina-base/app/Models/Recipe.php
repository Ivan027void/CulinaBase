<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'recipe_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'recipe_name',
        'gambar',
        'description',
        'preparation_time',
        'cooking_time'
    ];

    // Recipe model
        public function author()
        {
            return $this->belongsTo(User::class, 'author_id');
        }



    protected static function boot()
{
    parent::boot();

    static::deleting(function ($recipe) {
        // Detach relationships without deleting related records
        $recipe->ingredients()->detach();

        // Manually delete related records in the ingredients table
        Ingredient::where('recipe_id', $recipe->recipe_id)->delete();

        // Delete related records in the steps table
        Step::where('recipe_id', $recipe->recipe_id)->delete();
    });
}


    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients', 'recipe_id', 'ingredient_id')
            ->withPivot('quantity', 'size', 'note');
    }


    public function steps()
    {
        return $this->hasMany(Step::class, 'recipe_id');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class, 'recipe_id', 'recipe_id');
    }

}
