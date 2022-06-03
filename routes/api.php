<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuestionController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ReplyController;
use \App\Http\Controllers\LikeController;

Route::prefix('V1')->group(function (){
    Route::apiResource('/question', QuestionController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/question/{question}/reply', ReplyController::class);

    Route::get('/like/{reply}', [LikeController::class, 'like']);
    Route::get('/unlike/{reply}', [LikeController::class, 'unlike']);
});
