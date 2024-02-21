<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryLevelTwoRequest;
use App\Models\CategoryLevelTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryLevelTwoController extends Controller
{
    function get(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
            $data['rows'] = DB::table('category_level_two')
                ->where('name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_two')->count();

        } else {
            $data['rows'] = DB::table('category_level_two')
                ->orderBy('id', 'DESC')->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_two')->count();
        }
        return $data;
    }

    function create(CategoryLevelTwoRequest $request)
    {
        $result = CategoryLevelTwo::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function read(Request $request)
    {
        $result = CategoryLevelTwo::where('id', $request->id)->first();
        return $result;
    }

    function update(CategoryLevelTwoRequest $request)
    {
        $result = CategoryLevelTwo::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function delete($id)
    {
        $result = CategoryLevelTwo::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }
}
