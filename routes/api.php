<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::get('/test', function() {
    return response()->json([
        'message' => 'it is working in api section'
    ]);
});


Route::get('/gallery/index', function(Request $request){
    return response()->json([
        'message' => 'it is working fine',
        'data' => $request,
    ]);
});

Route::get('/gallery/show', [GalleryController::class, 'show']);
Route::get('/gallery/{id}', [GalleryController::class, 'findById']);
Route::delete('/gallery/{id}', [GalleryController::class, 'destroy']);
Route::put('/gallery/{id}', [GalleryController::class, 'update']);
Route::post('/gallery', [GalleryController::class, 'store']);
Route::delete('/gallery/delete/all', [GalleryController::class, 'deleteAll']);
Route::delete('/gallery/delete/multiple', [GalleryController::class, 'deleteMulitple']);
Route::put('/gallery/updateforstatus/{id}', [GalleryController::class, 'updateByStatus']);
Route::put('/gallery/update/status', [GalleryController::class, 'updateStatusByIds']);



Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/store', [CategoryController::class, 'store']);
Route::get('/category/show', [CategoryController::class, 'show']);
Route::put('/category/update/{id}', [CategoryController::class, 'update']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
Route::get('/category/{id}', [CategoryController::class, 'findById']);
Route::delete('/category/deleteAll', [CategoryController::class, 'deleteAll']);
Route::delete('/category/delete/multiple', [CategoryController::class, 'deleteMultiple']);
Route::put('/category/updateforstatus/{id}', [CategoryController::class, 'updateByStatus']);
Route::put('/category/updateforstatus/', [CategoryController::class, 'updateStatusByIds']);



Route::post('/auth/user/insert', [AuthController::class, 'store']);
Route::post('/auth/user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

