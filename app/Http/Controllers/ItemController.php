<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function fetchItems()
    {
        $items=Item::All();

        return response($items);
    }   
}
