<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login'])->name("login");

Route::get('testing', function () {
    return "Hello World!";
});

Route::resource('post', PostController::class);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('post', PostController::class)->except([
//         'create', 'edit'
//     ]);
// });
