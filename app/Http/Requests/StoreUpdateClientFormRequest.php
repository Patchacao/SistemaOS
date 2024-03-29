<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientFormRequest extends FormRequest
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
        $rules = [
            'whatsapp' => [
                'required',
                'boolean',
            ],
            'name' => [
                'required',
                'min:2',
                'max:50',
            ],
            'last_name' => [
                'required',
                'min:2',
                'max:100',
            ],
            'nickname' => [
                'min:2',
                'max:25',
                'nullable',
             ]
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'cpf' => [
                    'min:11',
                    'max:11',
                    'unique:customers',
                    'nullable',
                ],
                'phone_number' => [
                    'required',
                    'unique:customers',
                    'min:10',
                    'max:11',
                ]
            ];
        }
        
        return $rules;
    }
}
