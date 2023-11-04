<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recipe;

class RecipePolicy
{
    public function edit(User $user, Recipe $recipe)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Recipe $recipe)
    {
        return $user->role === 'admin';
    }
}
