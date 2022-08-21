<?php

namespace App\Modules\Novaposhta\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class NovaposhtaCalculateDeliveryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'citySender' => 'required|string',
            'cityRecipient' => 'required|string',

            'serviceType' => ['required',
                Rule::in(['DoorsDoors', 'DoorsWarehouse', 'WarehouseWarehouse', 'WarehouseDoors']),
            ],
            'deliveryType' => ['required',
                Rule::in(['Cargo', 'Documents', 'TiresWheels', 'Pallet']),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
