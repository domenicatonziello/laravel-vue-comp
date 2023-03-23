<?php

use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\Recipe_suggestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//rotte api recipes
Route::apiResource('recipes', RecipeController::class);

//rotte per articoli consigliati dagli utenti

Route::post('/contact-message', [Recipe_suggestController::class, 'send']);
