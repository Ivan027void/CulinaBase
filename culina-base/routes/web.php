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

// Route to handle the root (/) URL
Route::get('/', function () {
    return view('landingpage');
});

// Route to handle the root (/) URL
Route::get('/', [RecipeController::class, 'index']);
Route::get('/admin', [RecipeController::class, 'indexAdmin']);

// Route to handle the about page
Route::get('/option', function () {
    return view('option');
});

// Route to handle the about page
Route::get('/option', [RecipeController::class, 'fullIndex']);
// Route to handle the about page
Route::post('/search', [RecipeController::class, 'searchRecipes'])->name('search-recipes');

// Route to handle the about page
Route::get('/about', function () {
    return view('about-us');
});

// Route to handle the recipe page
Route::get('/recipe_info/{id}', [RecipeController::class, 'show']);
// Route to handle adding a new review
Route::post('/review-post', [RecipeController::class, 'postReview']);


// Route to handle the login page
Route::get('/login', function () {
    return view('loginpage');
});
// Route to handle the login page
Route::post('/Login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route for the registration page
Route::get('/regis', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);

//route for admin
Route::get('/adminPage', [AdminController::class, 'indexAdmin'])->name('admin.page');
Route::get('/recipe_info/{id}', [AdminController::class, 'showAdmin'])->name('recipes.show');
Route::get('/adminPage/edit_recipe/{id}', [AdminController::class, 'editAdmin'])->name('recipes.edit');
Route::delete('/adminPage/delete/{id}', [AdminController::class, 'delete'])->name('recipes.delete');
Route::get('/formAdmin', [AdminController::class, 'formAdmin'])->name('form-admin');
Route::post('/add-recipe', [AdminController::class, 'addRecipe'])->name('add-recipe');
Route::put('/adminPage/update/{id}', [AdminController::class, 'updateAdmin'])->name('recipes.update');
Route::post('/adminPage/add-ingredient/{recipe_id}', [AdminController::class, 'addIngredientAdmin'])->name('ingredients.add');
Route::put('/adminPage/{recipe_id}/update-ingredient/{ingredientId}', [AdminController::class, 'updateIngredientAdmin'])->name('ingredients.update');
Route::delete('/adminPage/{recipe_id}/delete-ingredient/{ingredientId}', [AdminController::class, 'deleteIngredientAdmin'])->name('ingredients.delete');
Route::post('/adminPage/add-step/{id}', [AdminController::class, 'addStepAdmin'])->name('steps.add');
Route::put('/adminPage/{id}/update-step/{stepId}', [AdminController::class, 'updateStepAdmin'])->name('steps.update');
Route::delete('/adminPage/{id}/delete-step/{stepId}', [AdminController::class, 'deleteStepAdmin'])->name('steps.delete');

//route for user
Route::get('/userPage', [UserPageController::class, 'userPage'])->name('user-page');
Route::get('/formUser', [UserPageController::class, 'formUser'])->name('form-user');
Route::post('/create-recipe', [UserPageController::class, 'createRecipe'])->name('create-recipe');
Route::get('/userPage/edit/{id}', [UserPageController::class, 'edit'])->name('edit-recipe');
Route::put('/userPage/edit/{id}', [UserPageController::class, 'update'])->name('update-recipe');

//route for ingredient
Route::get('/ingredientUser/{id}', [IngredientController::class, 'ingredientUser'])->name('ingredient-user');
Route::post('/storeIngredient/{recipe_id}', [IngredientController::class, 'storeIngredient'])->name('ingredients.store');
Route::put('/ingredientUser/{recipe_id}/updateIngredient/{ingredientId}', [IngredientController::class, 'updateIngredient'])->name('ingredient.update');
Route::delete('/ingredientUser/{recipe_id}/deleteIngredient/{ingredientId}', [IngredientController::class, 'deleteIngredient'])->name('ingredient.delete');


//route for step
Route::get('/stepUser/{id}', [StepController::class, 'stepUser'])->name('step-user');
// Route to handle adding a new step
Route::post('/stepUser/{id}/addStep', [StepController::class, 'addStep'])->name('add-step');

// Route to handle updating an existing step
Route::put('/stepUser/{id}/updateStep/{stepId}', [StepController::class, 'updateStep'])->name('update-step');
// Route to handle deleting an existing step
Route::delete('/stepUser/{id}/deleteStep/{stepId}', [StepController::class, 'deleteStep'])
    ->name('delete-step');