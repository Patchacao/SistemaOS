<?php

namespace App\Http\Controllers;


use App\Models\ObjectOrder;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function ObjectVerification(Request $request)
    {
        $ObjectSearch = "";
        
       if ($request->search!="") {
            
        $ObjectSearch=ObjectOrder::where('object_Number', $request->search)->get();
        }
        
      return response($ObjectSearch);
    
    }
}
