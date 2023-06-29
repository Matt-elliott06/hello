<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\User\UsersController;

use App\Http\Controllers\Api\Blog\BlogController;
use App\Http\Controllers\Api\Blog\BlogImagesController;
use App\Http\Controllers\Api\Widgets\WidgetsController;
use App\Http\Controllers\Api\todo\ToDoController;
use App\Http\Controllers\Api\Products\ProductsController;

use App\Http\Controllers\Api\Galleries\GalleriesController;
use App\Http\Controllers\Api\Galleries\GalleriesImagesController;


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

Route::namespace('\App\Http\Controllers\Api')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('/user', Auth\UserController::class);
        Route::post('/user',[UsersController::class,'update']);

        Route::get('/users',[UsersController::class,'index']);
        Route::post('/users',[UsersController::class,'add']);
        Route::get('/users/{id}',[UsersController::class,'get']);

        Route::patch('/users/{id}',[UsersController::class,'edit']);
        Route::delete('/users/{id}',[UsersController::class,'delete']);


    });

Route::namespace('\App\Http\Controllers\Api')
    ->group(function() {

        Route::get('/todo',[ToDoController::class,'index']);
        Route::post('/todo',[ToDoController::class,'add']);
        Route::get('/todo/{id}',[ToDoController::class,'get']);
        Route::put('/todo/{id}',[ToDoController::class,'edit']);
        Route::delete('/todo/{id}',[ToDoController::class,'delete']);

        Route::get('/products',[ProductsController::class,'index']);
        Route::get('/products/{id}',[ProductsController::class,'get']);
        Route::post('/products',[ProductsController::class,'add']);
        Route::post('/products/{id}',[ProductsController::class,'edit']);
        Route::delete('/products/{id}',[ProductsController::class,'delete']);





        Route::post('/register',[UsersController::class,'register']);



    });
