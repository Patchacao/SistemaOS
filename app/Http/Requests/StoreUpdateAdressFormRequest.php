<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAdressFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
           
            'street' => [
                'min:2',
                'max:100',
                'nullable',
                
            ],
            'adress_number' => [
                'min:2',
                'max:10',
                'nullable',
                
                
            ],
            'CEP' => [
                'min:8',
                'max:8',
                'nullable',
                
            ],
            'neighborhood' => [
                'min:2',
                'max:70',
                'nullable',
                
            ],
            'city' => [
                'min:2',
                'max:70',
                'required',
                
            ],
            'state' => [
                'min:2',
                'max:30',
                'required',
                
            ],
          
        ];
    }
}
