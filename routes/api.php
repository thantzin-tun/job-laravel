<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;


Route::post("login",[AuthController::class,"login"]);
Route::post("register",[AuthController::class,"register"]);


//Job Category
Route::get("job/category",[CategoryController::class,'index']);
Route::post("create/job/category",[CategoryController::class,'creatCategory']);

//Job City
Route::get("job/city",[CityController::class,"index"]);
Route::post("create/job/city",[CityController::class,"createCity"]);

//Job Level
Route::get("/job/level",[LevelController::class,"index"]);
Route::post("create/job/level",[LevelController::class,"createLevel"]);

//Job Post
Route::get("job/posts",[PostController::class,'index']);
Route::post("create/job/posts",[PostController::class,'createPost']);
Route::get("job/posts/search",[PostController::class,'searchJobs']);



Route::group(['middleware' => 'auth:api'], function () {
    
    //Token With User Profile
    Route::get("user/profile",[UserController::class,'getUserProfile']);

    //User Profile With User ID
    Route::get("user/search",[UserController::class,"getUser"]);

    Route::get("logout",[AuthController::class,"logout"]);

    //Get All Product
    Route::get("/product",[ProductController::class,'index']);

    //Create Product
    Route::post("create/product",[ProductController::class,'createPost']);

});