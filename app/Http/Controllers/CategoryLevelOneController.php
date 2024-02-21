<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryLevelOneRequest;
use App\Models\CategoryLevelOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryLevelOneController extends Controller
{
    function get(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
//        let SearchRgx = {"$regex": searchValue, "$options": "i"}
            $data['rows'] = DB::table('category_level_one')
                ->where('name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_one')->count();

        } else {
            $data['rows'] = DB::table('category_level_one')
                ->orderBy('id', 'DESC')->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_one')->count();
        }
        return $data;
    }

    function create(CategoryLevelOneRequest $request)
    {
        $result = CategoryLevelOne::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function read(Request $request)
    {
        $result = CategoryLevelOne::where('id', $request->id)->first();
        return $result;
    }

    function update(CategoryLevelOneRequest $request)
    {
        $result = CategoryLevelOne::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function delete($id)
    {
        $result = CategoryLevelOne::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }
}
