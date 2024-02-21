<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryLevelThreeRequest;
use App\Models\CategoryLevelThree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryLevelThreeController extends Controller
{
    function get(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
            $data['rows'] = DB::table('category_level_three')
                ->where('name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_three')->count();

        } else {
            $data['rows'] = DB::table('category_level_three')
                ->orderBy('id', 'DESC')->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_three')->count();
        }
        return $data;
    }

    function create(CategoryLevelThreeRequest $request)
    {
        $result = CategoryLevelThree::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        if ($result == true) return 1; else return 0;
    }

    function read(Request $request)
    {
        $result = CategoryLevelThree::where('id', $request->id)->first();
        return $result;
    }

    function update(CategoryLevelThreeRequest $request)
    {
        $result = CategoryLevelThree::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        if ($result == true) return 1; else return 0;
    }

    function delete($id)
    {
        $result = CategoryLevelThree::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }
}
