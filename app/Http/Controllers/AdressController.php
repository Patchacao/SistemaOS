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
        $adress->complement = $request->complement;
        $adress->neighborhood = $request->neighborhood;
        $adress->city = $request->city;
        $adress->state = $request->state;
        $adress->created_by = auth()->user()->name;

        $adress->save();

        return response()->json([
            'status' => 200,
            'message' => 'Endereço Cadastrado com Sucesso.',
            'id' => $adress->id,
        ]);
    }

    public function update(StoreUpdateAdressFormRequest $request, $id)
    {
        $adress = Adress::find($id);

        if ($adress) {

           
            $adress->street = $request->street;
            $adress->adress_number = $request->adress_number;
            $adress->CEP = $request->CEP;
            $adress->complement = $request->complement;
            $adress->neighborhood = $request->neighborhood;
            $adress->city = $request->city;
            $adress->state = $request->state;

            $adress->update();

            return response()->json([
                'status' => 200,
                'message' => 'Endereço Atualizado com Sucesso.',
                'id' => $adress->id,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Endereço Não Localizado.',
            ]);
        }
    }

    public function fetch(Request $request)
    {
        $Adress = "";

        if ($request->search != "") {

            $Adress = Adress::where('customer_id', $request->search)->get();
        }

        return response($Adress);
    }
}
