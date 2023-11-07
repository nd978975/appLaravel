<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('danh-muc')
  ->controller(CategoryController::class)
  ->group(function () {
    Route::get('/list', 'list');
    Route::get('/detail-by-id/{id}', 'detailByID');
    Route::get('/detail-by-slug/{slug}', 'detailBySlug');
  });

require __DIR__.'/auth.php';
