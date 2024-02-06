<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    function getSiteInfo()
    {
        $result=SiteInfo::get();
        return $result;
    }
}
