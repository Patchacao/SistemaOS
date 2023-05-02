<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateAdressFormRequest;
use App\Models\Adress;

class AdressController extends Controller
{
    public function store(StoreUpdateAdressFormRequest $request)
    {
        $adress = new Adress;
        
        $adress->customer_id = $request->customer_id;
        $adress->street = $request->street;
        $adress->adress_number = $request->adress_number;
        $adress->CEP = $request->CEP;
        $adress->neighborhood = $request->neighborhood;
        $adress->city = $request->city;
        $adress->state = $request->state;
        $adress->created_by = auth()->user()->name;

        $adress->save();
         
            return response()->json([
                'status'=>200,
                'message'=>'Endereço Cadastrado com Sucesso.',
                
            ]);
    }
}
