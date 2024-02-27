<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    function createIdentity(Request $request)
    {
       $result=Products::insert([

            'cat1_id'=>$request->cat1_id,
            'cat2_id'=>$request->cat2_id,
            'brand_id'=>$request->brand_id,
            'title'=>$request->title,
            'qty'=>$request->brand_id,
            'price'=>$request->price,
            'special_price'=>$request->discount,
            'pcode'=>rand(00000000,11111111)
        ]);
        if ($result == true) return 1; else return 0;
    }

    function createDetails()
    {

    }
    function createImages()
    {

    }

    function getProductListByRemark($remark)
    {
        $productList=Products::where('remark',$remark)->get();
        return $productList;
    }
}
