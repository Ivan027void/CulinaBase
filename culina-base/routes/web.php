<?php

use App\Models\Ingredient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});
Route::get('/', [RecipeController::class, 'index']);
Route::get('/admin', [RecipeController::class, 'indexAdmin']);

Route::get('/option', function () {
    return view('option');
});
Route::get('/option', [RecipeController::class, 'fullIndex']);
Route::post('/search', [RecipeController::class, 'searchRecipes'])->name('search-recipes');


Route::get('/about', function () {
    return view('about-us');
});

// Route::get('/recipe_info', function () {
//     return view('recipe_info');
// });

Route::get('/recipe_info/{id}', [RecipeController::class, 'show']);
Route::post('/review-post', [RecipeController::class, 'postReview']);

Route::get('/login', function () {
    return view('loginpage');
});

Route::post('/Login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route for the registration page
Route::get('/regis', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/adminPage', function () {
    return view('adminPage');
});
Route::get('/adminPage',[AdminController::class, 'indexAdmin'])->name('admin.page');
Route::get('/recipe_info/{id}', [AdminController::class, 'showAdmin'])->name('recipes.show');
Route::get('/adminPage/edit_recipe/{id}', [AdminController::class, 'edit'])->name('recipes.edit');
Route::delete('/adminPage/delete/{id}', [AdminController::class, 'delete'])->name('recipes.delete');
Route::get('/formAdmin', [AdminController::class, 'formAdmin'])->name('form-admin');
Route::post('/add-recipe', [AdminController::class, 'addRecipe'])->name('add-recipe');

Route::get('/userPage', [UserPageController::class, 'userPage'])->name('user-page');
Route::get('/formUser', [UserPageController::class, 'formUser'])->name('form-user');
Route::post('/create-recipe', [UserPageController::class, 'createRecipe'])->name('create-recipe');
Route::get('/userPage/edit/{id}', [UserPageController::class, 'edit'])->name('edit-recipe');
Route::put('/userPage/edit/{id}', [UserPageController::class, 'update'])->name('update-recipe');


Route::get('/ingredientUser/{id}', [IngredientController::class, 'ingredientUser'])->name('ingredient-user');
Route::post('/storeIngredient/{recipe_id}', [IngredientController::class, 'storeIngredient'])->name('ingredients.store');



Route::get('/stepUser/{id}', [StepController::class, 'stepUser'])->name('step-user');
// Route to handle adding a new step
Route::post('/stepUser/{id}/addStep', [StepController::class, 'addStep'])->name('add-step');

// Route to handle updating an existing step
Route::put('/stepUser/{id}/updateStep/{stepId}', [StepController::class, 'updateStep'])->name('update-step');

Route::delete('/stepUser/{id}/deleteStep/{stepId}', [StepController::class, 'deleteStep'])
    ->name('delete-step');