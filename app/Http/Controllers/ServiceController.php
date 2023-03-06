<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ServiceController extends Controller
{
    public function LoadServices(Request $request)
    {
        
        $services = Item::with('services')->find($request->search);
        $servicesList =  $services->services->toArray();

        return response($servicesList);
    }
}
