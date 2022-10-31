<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
// Route::apiResources([
//     'material' => MaterialController::class,
//     'material-type' => MaterialTypeController::class,
// ]);
Route::prefix('material')->name('material')->group(function(){
    Route::get('/',[MaterialController::class,'index']);
    Route::post('/',[MaterialController::class,'store']);
    Route::delete('/destroy/{id}',[MaterialController::class,'destroy']);
    Route::put('/update/{id}',[MaterialController::class,'editMaterial']);

});
Route::prefix('material-type')->name('material-type')->group(function(){
    Route::get('/',[MaterialTypeController::class,'index']);
    Route::post('/destroy/{id}',[MaterialTypeController::class,'store']);
    Route::delete('/{id}',[MaterialTypeController::class,'destroy']);
});
Route::prefix('room')->name('room')->group(function(){
    Route::get('/',[RoomController::class,'index']);
    Route::post('/',[RoomController::class,'store']);
    Route::delete('/destroy/{id}',[RoomController::class,'destroy']);
    Route::put('/update/{id}',[RoomController::class,'updateRoom']);
    Route::get('/get_list_slug',[RoomController::class,'getListSlug']);
    Route::get('/get_by_slug/{slug}',[RoomController::class,'getBySlug']);
});
Route::prefix('product')->name('product')->group(function(){
    Route::get('/',[ProductController::class,'index']);
    Route::post('/',[ProductController::class,'store']);
    Route::delete('/destroy/{id}',[ProductController::class,'destroy']);
    Route::put('/update/{id}',[ProductController::class,'editProduct']);
    Route::delete('/image/destroy/{id}',[ProductController::class,'deleteProductImage']);
    Route::get('/get_list_slug',[ProductController::class,'getListSlug']);
    Route::get('/get_by_slug/{slug}',[ProductController::class,'getBySlug']);
    route::get('/get_by_cate/{cate}',[ProductController::class,'getByCate']);
    route::get('/get_new_list',[ProductController::class,'getNewList']);
    route::get('/get_decide_list',[ProductController::class,'getDecideList']);
    route::get('/make_decided/{id}',[ProductController::class,'makeDecided']);
    route::get('/get_by_cate/{cate}',[ProductController::class,'getByCate']);
    route::get('/get_by_room/{room}',[ProductController::class,'getByRoom']);
});

Route::prefix('category')->name('product')->group(function(){
    Route::get('/',[CategoryController::class,'index']);
    Route::post('/',[CategoryController::class,'store']);
    Route::delete('/destroy/{id}',[CategoryController::class,'destroy']);
    Route::put('/update/{id}',[CategoryController::class,'editCate']);
    Route::get('/get_list_slug',[CategoryController::class,'getListSlug']);
    Route::get('/get_by_slug/{slug}',[CategoryController::class,'getBySlug']);
});