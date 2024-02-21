<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    function get(Request $request)
    {
        $pageNo = (int)$request->pageNo;
        $perPage = (int)$request->perPage;
        $skipRow = ($pageNo - 1) * $perPage;
        $searchValue = $request->searchKey;
        $searchTerm = '%' . $searchValue . '%';

        if ($searchValue !== "0") {
            $data['rows'] = DB::table('brands')
                ->where('name', "LIKE", $searchTerm)
                ->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('brands')->count();

        } else {
            $data['rows'] = DB::table('brands')
                ->orderBy('id', 'DESC')->skip($skipRow)->take($perPage)->get();
            $data['total'] = DB::table('brands')->count();
        }
        return $data;
    }

    function create(BrandRequest $request)
    {
        $result = Brand::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function read(Request $request)
    {
        $result = Brand::where('id', $request->id)->first();
        return $result;
    }

    function update(BrandRequest $request)
    {
        $result = Brand::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);
        if ($result == true) return 1; else return 0;
    }

    function delete($id)
    {
        $result = Brand::where('id', $id)->delete();
        if ($result == true) return 1; else return 0;
    }
}
