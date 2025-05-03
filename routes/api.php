<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; // Import the controller for handling signup requests

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This file is where you can define all of your API routes. These routes
| are loaded automatically by the RouteServiceProvider within a group
| that is assigned the "api" middleware group.
|
*/

// Public route for user signup (registration)
Route::post('/signup', [AuthController::class, 'signup']);

// Protected route to get the authenticated user's data (requires API token)
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
