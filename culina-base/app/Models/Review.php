<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'review_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'recipe_id', 'user_id', 'review_date', 'reviewer_name', 'review_content',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'recipe_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
