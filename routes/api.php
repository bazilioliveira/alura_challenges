<?php

use App\Http\Controllers\VideosController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rota para obter todos os vídeos da database
Route::get('videos', [VideosController::class, 'todosVideos']);

//Rota para obter vídeo específico pela ID
Route::get('videos/{id}', [VideosController::class, 'getOne']);
