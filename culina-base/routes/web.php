<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
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

Route::get('/about', function () {
    return view('about-us');
});

// Route::get('/recipe_info', function () {
//     return view('recipe_info');
// });

Route::get('/recipe_info/{id}', [RecipeController::class, 'show']);


Route::get('/login', function () {
    return view('loginpage');
});

Route::post('/Login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route for the registration page
Route::get('/regis', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/userPage', function () {
    return view('userPage');
});


Route::get('/adminPage', function () {
    return view('adminPage');
});
Route::get('/adminPage',[RecipeController::class, 'indexAdmin'])->name('admin.page');
Route::get('/recipe_info/{id}', [RecipeController::class, 'showAdmin'])->name('recipes.show');
Route::get('/adminPage/edit_recipe/{id}', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::delete('/adminPage/delete/{id}', [RecipeController::class, 'delete'])->name('recipes.delete');


