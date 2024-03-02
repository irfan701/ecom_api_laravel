<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{

    function createIdentity(Request $request)
    {
        $last_id = Products::insertGetId([

            'cat1_id' => $request->cat1_id,
            'cat2_id' => $request->cat2_id,
            'brand_id' => $request->brand_id,
            'title' => $request->title,
            'qty' => $request->brand_id,
            'price' => $request->price,
            'special_price' => $request->discount,
            'pcode' => rand(00000000, 11111111)
        ]);

        $result = ProductDetails::insert(['product_id' => $last_id]);
        if ($result == true) return 1; else return 0;
    }

    function createDetails(Request $request)
    {
        $color = implode(',', $request->color);
        $size = implode(',', $request->size);

        ProductDetails::where('product_id',$request->product_id)->update([

         //   'product_id' => $request->product_id,
            'size' => $size,
            'color' => $color,
            'bullet_point' => $request->bullet_point,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,

        ]);
        $result =Products::where('id',$request->product_id)->update(['details_status'=>1]);

        if ($result == true) return 1; else return 0;
    }

    function createImages()
    {

    }

    function get(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
            $data['rows'] = Products::with('category1', 'category2', 'brands')
                ->where('title', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)
                ->get();
            $data['total'] = Products::count();

        } else {
            $data['rows'] = Products::with('category1', 'category2', 'brands')
                ->orderBy('id', 'DESC')
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = Products::count();
        }
        return $data;
    }

    function delete($id)
    {
        $result = Products::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }

    function getProductListByRemark($remark)
    {
        $productList = Products::where('remark', $remark)->get();
        return $productList;
    }

}
