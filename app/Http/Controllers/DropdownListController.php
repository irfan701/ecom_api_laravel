<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryLevelOne;
use App\Models\CategoryLevelTwo;
use App\Models\Products;
use Illuminate\Http\Request;

class DropdownListController extends Controller
{
    function fetchCategoryLevelOneList()
    {
        return CategoryLevelOne::get();
    }
    function fetchCategoryLevelTwoList($cat1Id)
    {
        return CategoryLevelTwo::where('cat1_id',$cat1Id)->get();
    }
    function fetchBrandList()
    {
        return Brand::get();
    }
    function fetchProductCodeList()
    {
        return Products::with('category1','category2','brands')
          //  ->select('')
            ->where('pcode','!=',0)->orderBy('id','DESC')->get();
    }

}
