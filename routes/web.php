<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LoginV2Controller;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilsController;
use App\Http\Middleware\JwtMiddleware;
use App\Ingredient;
use App\Recipe;
use Illuminate\Support\Facades\Route;

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
    $recipes = Recipe::get();

    $ingredients = Ingredient::get();
    $map = $ingredients->groupBy(function($item){
        return $item->type;
    });

    return view('welcome', compact('recipes', 'ingredients', 'map'));
});

Route::get('/learn', function () {
    return view('learn');
});
Route::get('/prueb2a', function () {
    return view('prueba');
});

// Auth::routes();

Route::get('login', [LoginV2Controller::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [LoginV2Controller::class, 'login'])->name('login');

 // Registration Routes...
 Route::get('register', [LoginV2Controller::class, 'showRegistrationForm'])->name('showRegistrationForm');
 Route::post('register', [LoginV2Controller::class, 'register'])->name('register');

Route::group(['middleware' => JwtMiddleware::class], function() {
    Route::post('logout', [LoginV2Controller::class, 'logout'])->name('logout');
/*
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('ingredients', IngredientController::class);

    Route::post('filter', 'App\Http\Controllers\UtilsController@recipe')->name('recip.filter');
});
