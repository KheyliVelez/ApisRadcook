<?php

use App\Http\Controllers\Api\ForoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\UserController;
use App\Ingredient;
use App\Models\Foro;
use App\Recipe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login/v2', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::get('get_datauser', [UserController::class, 'dataUser']);

Route::post('user/create/v2', [RegisterController::class, 'create']);

Route::post('ingredient/create', [IngredientController::class, 'create']);

Route::get('ingredients', [IngredientController::class, 'getAll']);

Route::get('ingredient/{id}', [IngredientController::class, 'getById']);

Route::post('recipe/create', [RecipeController::class, 'create']);

Route::get('recipes', [RecipeController::class, 'getAll']);

Route::get('recipe/{id}', [RecipeController::class, 'getById']);

Route::post('recipe/{id}/edit', [RecipeController::class, 'update']);

Route::delete('recipe/{id}/delete', [RecipeController::class, 'destroy']);

Route::get('ingredient/{id}/recipes', [IngredientController::class, 'getRecipesByIngredient']);

Route::get('ingredients/recipes', [IngredientController::class, 'getRecipesByIngredientV2']);

Route::post('foro/create', [ForoController::class, 'create']);

Route::delete('foro/{id}/delete', [ForoController::class, 'destroy']);

Route::get('foros', [ForoController::class, 'getAll']);

Route::get('foros/user/{id}', [ForoController::class, 'getByUserId']);

Route::get('recipes/user/{id}', [RecipeController::class, 'getByUserId']);
