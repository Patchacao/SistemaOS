<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\LinkableObject;


class LinkableObjectController extends Controller
{
    public function LoadLinkableObjects(Request $request)
    {
        
        $linkedObjects = Item::with('linkable_objects')->first();
        dd($linkedObjects->linkable_objects);

    }
}

