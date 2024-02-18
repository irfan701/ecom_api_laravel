<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function getData(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
//        let SearchRgx = {"$regex": searchValue, "$options": "i"}
            $data['rows'] = DB::table('categories')
                ->where('cat_name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('categories')->count();

        } else {
            $data['rows'] = DB::table('categories')
                ->orderBy('id', 'DESC')->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('categories')->count();
        }
        return $data;
    }

    function create(Request $request)
    {
        $result = Category::insert([
            'cat_name' => $request->cat_name,
            'cat_image' => $request->cat_image,
        ]);
        return response()->json(['result'=>$result]);
    }

    function read(Request $request)
    {
        $result = Category::where('id', $request->id)->first();
        return $result;
    }

    function update(Request $request)
    {
        $result = Category::where('id', $request->id)->update([
            'cat_name' => $request->cat_name,
            'cat_image' => $request->cat_image,
        ]);
        return response()->json(['result'=>$result]); //1
    }

    function delete($id)
    {
        $result = Category::where('id', $id)->delete();
        return response()->json(['result'=>$result]); //1
    }

    function getCategoryDetails()
    {
        $CategoryDetailsArray = [];
        $parentCategory = Category::get();
        foreach ($parentCategory as $category) {
            $subCategory = SubCategory::where('cat_id', $category->id)->get();
            $items = [
                'cat_name' => $category->cat_name,
                'cat_img' => $category->cat_image,
                'subCategory' => $subCategory,
            ];
            array_push($CategoryDetailsArray, $items);
        }
        return $CategoryDetailsArray;
    }
}
