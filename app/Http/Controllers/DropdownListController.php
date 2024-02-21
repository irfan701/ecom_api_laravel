<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryLevelOne;
use App\Models\CategoryLevelTwo;
use Illuminate\Http\Request;

class DropdownListController extends Controller
{
    function fetchCategoryLevelOneList()
    {
        return CategoryLevelOne::get();
    }
    function fetchCategoryLevelTwoList()
    {
        return CategoryLevelTwo::get();
    }

}
