<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;
class ServiceOrderController extends Controller
{
    public function ServiceOrderVerification(Request $request)
    {
        $OsSearch = "";
        
       if ($request->search!="") {

       
           
       $OsSearch=ServiceOrder::where('OS_Number', $request->search)->get();
       
      }
        
      return response($OsSearch);
    
    }
}
