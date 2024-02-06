<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Visitor;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function insertContactDetails(Request $request)
    {
        $name=$request->name;
        $mobile=$request->mobile;
        $msg=$request->message;
        date_default_timezone_set("Asia/Dhaka");
        $contact_time=date("h:i:sa");
        $contact_date=date("d-m-Y");

        $result=Contact::insert([
            'name'=>$name,
            'mobile'=>$mobile,
            'message'=>$msg,
            'contact_time'=>$contact_time,
            'contact_date'=>$contact_date,
        ]);
        return response()->json(['result' => $result]);
    }
}
