<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryLevelTwoRequest;
use App\Models\CategoryLevelOne;
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
                ->join('category_level_one', 'category_level_two.cat1_id', '=', 'category_level_one.id')
                ->select('category_level_two.*','category_level_one.cat1_name')
                ->where('cat2_name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)
                ->get();
            $data['total'] = DB::table('category_level_two')->count();

        } else {
            $data['rows'] = DB::table('category_level_two')
                ->join('category_level_one', 'category_level_two.cat1_id', '=', 'category_level_one.id')
                ->select('category_level_two.*','category_level_one.cat1_name')
                ->orderBy('category_level_two.id', 'DESC')
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('category_level_two')->count();
        }
        return $data;
    }

    function create(CategoryLevelTwoRequest $request)
    {
        $result = CategoryLevelTwo::insert([
            'cat1_id' => $request->cat1_id,
            'cat2_name' => $request->cat2_name,
            'cat2_slug' => Str::slug($request->cat2_name),
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
            'cat1_id' => $request->cat1_id,
            'cat2_name' => $request->cat2_name,
            'cat2_slug' => Str::slug($request->cat2_name),
        ]);
        if ($result == true)  return 1; else return 0;
    }
    function delete($id)
    {
        $result = CategoryLevelTwo::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }

}
//       JOIN TECHNIQUES
//        DB::table('ForeignTable')->join('MainTable','ForeignTable.foreign_id','=','MainTable.id');
//        DB::table('ForeignTable')->join('MainTable','MainTable.id','=','ForeignTable.foreign_id');
