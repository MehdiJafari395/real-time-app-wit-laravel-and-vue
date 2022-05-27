<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuestionController;

Route::prefix('V1')->group(function (){
    Route::apiResource('/question', QuestionController::class);
});
