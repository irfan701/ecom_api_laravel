<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\ProductMultiImg;
use App\Models\Products;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductImageController extends Controller
{
    function createMainImage(Request $request, $product_id, UtilityService $utility)
    {
        $new_file = $request->file('main_image');
        $productDetails = ProductDetails::where('product_id', $product_id)->first();
        $product = Products::where('id', $product_id)->first();
        if ($productDetails->main_image != null) {
            $utility->RemoveFile("upload/products/", $productDetails->main_image);
            $save_url = $utility->FileProcess($new_file);
            $productDetails->main_image = $save_url;
            $productDetails->save();
            $result = $product->image_status = 1;
            $product->save();
            if ($result == true) return 1; else return 0;
        } else {
            if ($new_file) {
                $save_url = $utility->FileProcess($new_file);
                $productDetails->main_image = $save_url;
                $productDetails->save();
                $result = $product->image_status = 1;
                $product->save();
                if ($result == true) return 1; else return 0;
            }
        }
    }

    function createMultiImage(Request $request, UtilityService $utility)
    {
//        $request->validate([
//            'images' => 'required|images|size:2048',
//        ]);
        //  $productDetails = ProductMultiImg::where('product_id', $request->product_id)->first();
        $product = Products::where('id', $request->product_id)->first();
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $file) {
                $save_url = $utility->FileProcess($file);
                ProductMultiImg::create(['product_id' => $request->product_id, 'images' => $save_url]);
                $result = $product->mimg_status = 1;
                $product->save();
            }
            if ($result == true) return 1; else return 0;
        }
    }


}
