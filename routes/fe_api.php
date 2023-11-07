<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article\FeArticleController;

Route::prefix('art')
  ->controller(FeArticleController::class)
  ->group(function () {
    Route::get('/list', 'art_list');
    Route::get('/{slug}', 'abc');
  });