<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
