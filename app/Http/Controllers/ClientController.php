<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreUpdateClientFormRequest;

class ClientController extends Controller
{

    public function store(StoreUpdateClientFormRequest $request)
    {
        $customer = new Customer;

        $customer->phone_number = $request->phone_number;
        $customer->whatsapp = $request->whatsapp;
        $customer->name = $request->name;
        $customer->last_name = $request->last_name;
        $customer->nickname = $request->nickname;
        $customer->cpf = $request->cpf;
        $customer->created_by = auth()->user()->name;

        $customer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Cliente Cadastrado com Sucesso.',
            'id' => $customer->id,
        ]);
    }

    public function update(StoreUpdateClientFormRequest $request, $id)
    {
        $customer = Customer::find($id);

        if ($customer) {

            $customer->phone_number = $request->phone_number;
            $customer->whatsapp = $request->whatsapp;
            $customer->name = $request->name;
            $customer->last_name = $request->last_name;
            $customer->nickname = $request->nickname;
            $customer->cpf = $request->cpf;
          
            $customer->update();

            return response()->json([
                'status' => 200,
                'message' => 'Cliente Atualizado com Sucesso.',
                'id' => $customer->id,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'Cliente Não Localizado.',
            ]);
        }
    }


    public function search(Request $request)
    {
        $clientSearch = "";

        if ($request->search != "") {

            $clientSearch = Customer::where('name', 'Like', '%' . $request->search . '%')->orWhere('last_name', 'Like', '%' . $request->search . '%')->orWhere('nickname', 'Like', '%' . $request->search . '%')->limit(20)->get();
        }


        return response($clientSearch);
    }

    public function PhoneVerification(Request $request)
    {
        $PhoneSearch = "";

        if ($request->search != "") {

            $PhoneSearch = Customer::where('phone_number', $request->search)->get();
        }

        return response($PhoneSearch);
    }
}
