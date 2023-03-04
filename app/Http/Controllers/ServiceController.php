<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function LoadServices(Request $request)
    {
        
        $services = Service::with('linkable_objects')->find($request->search);
        $servicesList =  $services->linkable_objects->toArray();

        return response($servicesList);
    }
}
