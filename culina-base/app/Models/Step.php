<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $table = 'steps'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'step_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'recipe_id',
        'step_order',
        'description',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
