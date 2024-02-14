<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function getProductListByRemark($remark)
    {
        $productList=Products::where('remark',$remark)->get();
        return $productList;
    }
}
