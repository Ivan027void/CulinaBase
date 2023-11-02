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
        'cooking_time',
        'category_id',
    ];

    public function addGambar($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $fileName);
        $this->gambar = $fileName;
        $this->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
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
