<?php

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["prefix" => "user"], function () {
    //public route
    Route::post('login', [UserController::class, 'loginUser']);
    Route::post('register', [UserController::class, 'newUser']);
    
    //private route
    Route::group(["middleware" => "auth:sanctum"], function () {

        //get methods
        Route::get('/info', [UserController::class, 'info']);
        Route::get('/all', [UserController::class, 'getAllUser']);
        Route::get('/{id}', [UserController::class, 'getUser']);

        //post methods
        Route::post('/update', [UserController::class, 'updateUser']);
        Route::post('/fav-pokemon', [PokemonController::class, 'favoritePokemon']);
        Route::post('/like-pokemon', [PokemonController::class, 'likePokemon']);
        Route::post('/hate-pokemon', [PokemonController::class, 'hatePokemon']);
        Route::post('/store-fav-pokemon', [PokemonController::class, 'storeFavoritePokemon']);
        Route::post('/store-like-pokemon', [PokemonController::class, 'storeLikePokemon']);
        Route::post('/store-hate-pokemon', [PokemonController::class, 'storeHatePokemon']);
        Route::post('/remove-fav-pokemon', [PokemonController::class, 'removeFavPokemon']);
        Route::post('/remove-like-pokemon', [PokemonController::class, 'removeLikePokemon']);
        Route::post('/remove-hate-pokemon', [PokemonController::class, 'removeHatePokemon']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});



    
