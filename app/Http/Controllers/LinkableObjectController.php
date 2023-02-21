<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\LinkableObject;


class LinkableObjectController extends Controller
{
    public function LoadLinkableObjects(Request $request)
    {
        
        $linkableObjects = Item::with('linkable_objects')->find($request->search);
        $linkableObjectsList =  $linkableObjects->linkable_objects->toArray();

        return response($linkableObjectsList);
    }
}

