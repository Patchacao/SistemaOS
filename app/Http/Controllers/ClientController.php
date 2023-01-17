<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class ClientController extends Controller
{
    public function store(Request $request) {
        
        $customer = new Customer;
        
        $customer->phone_number = $request->cellphone;
        $customer->whatsapp = $request->whatsapp;
        $customer->name = $request->name;
        $customer->last_name = $request->last_name;
        $customer->nickname = $request->nickname;
        $customer->cpf = $request->cpf;
        $customer->created_by = auth()->user()->name;
        
        $customer->save();

        return redirect('/clients');
    }
}
