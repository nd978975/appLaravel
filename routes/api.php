<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\FeArticleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\User\UserController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum'])
  ->prefix('user')
  ->controller(UserController::class)
  ->group(function () {
    Route::get('/list', 'getListUser');
    Route::post('/change-role', 'changeRole');
  });

Route::middleware(['auth:sanctum'])
  ->prefix('article')
  ->controller(ArticleController::class)
  ->group(function () {
    Route::get('/lists', 'lists');
    Route::get('/lists-trash', 'listsTrash');
    Route::post('/create', 'create');
    Route::get('/detail/{id}', 'detail');
    Route::post('/edit', 'edit');
    Route::post('/move-to-trash', 'moveToTrash');
    Route::post('/move-to-draft', 'moveToDraft');
    Route::post('/restore', 'restore');
    Route::post('/delete', 'delete');
    Route::post('/public', 'publicItem');
    Route::post('/set-role-edit', 'setRoleEdit');
  });

Route::middleware(['auth:sanctum'])
  ->prefix('category')
  ->controller(CategoryController::class)
  ->group(function () {
    Route::get('/list', 'list');
    Route::get('/list-trash', 'listTrash');
    Route::post('/create', 'create');
    Route::post('/edit', 'edit');
    Route::post('/move-to-trash', 'moveToTrash');
    Route::post('/move-to-draft', 'moveToDraft');
    Route::post('/restore', 'restore');
    Route::post('/delete', 'delete');
    Route::post('/public', 'publicItem');
    Route::post('/set-role-edit', 'setRoleEdit');
  });

Route::prefix('fe-article')
  ->controller(FeArticleController::class)
  ->group(function () {
    Route::get('/list', 'art_list');
    Route::get('/{slug}', 'detail');
  });

Route::prefix('danh-muc')
  ->controller(CategoryController::class)
  ->group(function () {
    Route::get('/list', 'list');
    Route::get('/detail-by-id/{id}', 'detailByID');
    Route::get('/detail-by-slug/{slug}', 'detailBySlug');
  });