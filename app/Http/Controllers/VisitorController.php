<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    function getVisitorDetails()
    {
        $ip_address=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $visit_time=date("h:i:sa");
        $visit_date=date("d-m-Y");

        $result=Visitor::insert([
            'ip_address'=>$ip_address,
            'visit_time'=>$visit_time,
            'visit_date'=>$visit_date
        ]);
        return response()->json(['result' => $result]);
    }
}
