<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send/VisitorDetails',[VisitorController::class,'sendVisitorDetails']);
Route::post('/insert/ContactDetails',[ContactController::class,'insertContactDetails']);
Route::get('/get/siteInfo',[SiteInfoController::class,'getSiteInfo']);
Route::get('/get/CategoryDetails',[CategoryController::class,'getCategoryDetails']);
Route::get('/get/productListByRemark/{remark}',[ProductsController::class,'getProductListByRemark']);


