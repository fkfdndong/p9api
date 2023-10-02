<?php


use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function () {
    // Routes d'authentification
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::get('/auth/profile', [AuthController::class, 'profile']); 
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Routes pour les articles
    Route::post('/articles', [ArticleController::class, 'create']);
    Route::get('/articles/{article}', [ArticleController::class, 'show']); 
    Route::put('/articles/{article}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article}', [ArticleController::class, 'delete']);
});

// Route pour récupérer l'utilisateur authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

