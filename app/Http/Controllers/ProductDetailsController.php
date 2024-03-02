<?php

namespace App\Http\Controllers;

use App\Models\CategoryLevelOne;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
  function readDetails(Request $request)
  {
      $result = ProductDetails::where('product_id', $request->product_id)->first();
      return $result;
  }
}
