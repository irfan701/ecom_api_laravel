<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryLevelOneController;
use App\Http\Controllers\CategoryLevelThreeController;
use App\Http\Controllers\CategoryLevelTwoController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DropdownListController;
use App\Http\Controllers\BrandController;

Route::post('/login',[AuthController::class,'onLogin'])->middleware('guest');
Route::post('/register',[AuthController::class,'onRegister'])->middleware('guest');
Route::post('/logout',[AuthController::class,'onLogout'])->middleware('auth:sanctum');

Route::post('/reset/password/link/email',[AuthController::class,'ResetPasswordLinkEmail'])->middleware('guest');
Route::post('/reset/password',[AuthController::class,'ResetPassword'])->name('reset.password')->middleware(['guest','signed']);

Route::post('/email/verify/link',[AuthController::class,'emailVerifyLinkToEmail'])->middleware('auth:sanctum');
Route::post('/email/verify',[AuthController::class,'emailVerify'])->name('email.verify')->middleware(['auth:sanctum','signed']);

Route::group(['prefix'=>'category1','middleware'=>['auth:sanctum']],function () {
    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryLevelOneController::class,'get']);
    Route::post('/create',[CategoryLevelOneController::class,'create']);
    Route::get('/read/{id}',[CategoryLevelOneController::class,'read']);
    Route::post('/update/{id}',[CategoryLevelOneController::class,'update']);
    Route::get('/delete/{id}',[CategoryLevelOneController::class,'delete']);
});

Route::prefix('category2')->group(function () {
    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryLevelTwoController::class,'getData']);
    Route::post('/create',[CategoryLevelTwoController::class,'create']);
    Route::get('/read/{id}',[CategoryLevelTwoController::class,'read']);
    Route::post('/update/{id}',[CategoryLevelTwoController::class,'update']);
    Route::get('/delete/{id}',[CategoryLevelTwoController::class,'delete']);
});

Route::prefix('category3')->group(function () {
    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[CategoryLevelThreeController::class,'getData']);
    Route::post('/create',[CategoryLevelThreeController::class,'create']);
    Route::get('/read/{id}',[CategoryLevelThreeController::class,'read']);
    Route::post('/update/{id}',[CategoryLevelThreeController::class,'update']);
    Route::get('/delete/{id}',[CategoryLevelThreeController::class,'delete']);
});

Route::get('/cat1/get',[DropdownListController::class,'fetchCategoryLevelOneList']);
Route::get('/cat2/get',[DropdownListController::class,'fetchCategoryLevelTwoList']);

Route::prefix('brand')->group(function () {
    Route::get('/get/{pageNo}/{perPage}/{searchKey}',[BrandController::class,'getData']);
    Route::post('/create',[BrandController::class,'create']);
    Route::get('/read/{id}',[BrandController::class,'read']);
    Route::post('/update/{id}',[BrandController::class,'update']);
    Route::get('/delete/{id}',[BrandController::class,'delete']);
});




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
