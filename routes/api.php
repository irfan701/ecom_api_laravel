<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AuthController;


Route::post('/login',[AuthController::class,'onLogin'])->middleware('guest');
Route::post('/register',[AuthController::class,'onRegister'])->middleware('guest');
Route::post('/logout',[AuthController::class,'onLogout'])->middleware('auth:sanctum');

Route::post('/reset/password/link/email',[AuthController::class,'ResetPasswordLinkEmail'])->middleware('guest');
Route::post('/reset/password',[AuthController::class,'ResetPassword'])->name('reset.password')->middleware(['guest','signed']);

Route::post('/email/verify/link',[AuthController::class,'emailVerifyLinkToEmail'])->middleware('auth:sanctum');
Route::post('/email/verify',[AuthController::class,'emailVerify'])->name('email.verify')->middleware(['auth:sanctum','signed']);

//Route::prefix('category1')->group(function () {
//    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryController::class,'getData']);
//    Route::post('/create',[CategoryController::class,'create']);
//    Route::get('/read/{id}',[CategoryController::class,'read']);
//    Route::post('/update/{id}',[CategoryController::class,'update']);
//    Route::get('/delete/{id}',[CategoryController::class,'delete']);
//});
//
//Route::prefix('category2')->group(function () {
//    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryController::class,'getData']);
//    Route::post('/create',[CategoryController::class,'create']);
//    Route::get('/read/{id}',[CategoryController::class,'read']);
//    Route::post('/update/{id}',[CategoryController::class,'update']);
//    Route::get('/delete/{id}',[CategoryController::class,'delete']);
//});
//
//Route::prefix('category3')->group(function () {
//    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryController::class,'getData']);
//    Route::post('/create',[CategoryController::class,'create']);
//    Route::get('/read/{id}',[CategoryController::class,'read']);Sass
//    Route::post('/update/{id}',[CategoryController::class,'update']);
//    Route::get('/delete/{id}',[CategoryController::class,'delete']);
//});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send/VisitorDetails',[VisitorController::class,'sendVisitorDetails']);
Route::post('/insert/ContactDetails',[ContactController::class,'insertContactDetails']);
Route::get('/get/siteInfo',[SiteInfoController::class,'getSiteInfo']);
Route::get('/get/CategoryDetails',[CategoryController::class,'getCategoryDetails']);
Route::get('/get/productListByRemark/{remark}',[ProductsController::class,'getProductListByRemark']);
Route::get('/get/sliderInfo',[SliderController::class,'getSliderInfo']);
Route::get('/get/productDetails/{product_id}',[ProductDetailsController::class,'getProductDetails']);
Route::get('/get/notificationHistory',[NotificationController::class,'getNotificationHistory']);
Route::get('/get/productBySearch/{key}',[ProductsController::class,'getProductBySearch']);
Route::get('/get/similarProducts/{subcategory}',[ProductsController::class,'similarProducts']);


Route::get('/products',function (){
  return \Illuminate\Support\Facades\DB::table('product_list')->get();
});






