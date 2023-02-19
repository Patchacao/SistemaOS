<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectNumber;

class ObjectNumberController extends Controller
{
    public function ObjectNumberVBerification(Request $request)
    {
        $ObjectNumber = "";
        
       if ($request->search!="") {

       
           
        $ObjectNumber=ObjectNumber::where('Object_Number', $request->search)->get();
       
      }
        
      return response($ObjectNumber);
    
    }
}
