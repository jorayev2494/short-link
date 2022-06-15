<?php

use App\Http\Controllers\ShortController;
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

Route::get('/{short_url}', [ShortController::class, 'visit']);
Route::post('/', [ShortController::class, 'store']);
Route::get('/', [ShortController::class, 'index']);