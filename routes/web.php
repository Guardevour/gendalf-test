<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProductController;


use App\Http\Controllers\ApiProductController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login']);


Route::get('/users', function () {
    return view('users');
});
Route::post('/userscreate',  [UserProfileController::class, 'create']);
Route::post('/usersupdate',  [UserProfileController::class, 'update']);
Route::post('/usersdelete',  [UserProfileController::class, 'delete']);
Route::get('/products', function () {
    return view('products');
});
Route::post('/productscreate',  [ProductController::class, 'create']);
Route::post('/productsupdate',  [ProductController::class, 'update']);
Route::post('/productsdelete',  [ProductController::class, 'delete']);

//Api
Route::get('/items', [ApiProductController::class, 'showItems']);
Route::get('/items/{id}', [ApiProductController::class, 'show']);
Route::get('/categories', [ApiProductController::class, 'showCategories']);



