<?php

namespace App\Http\Requests;

use App\Models\ClientPaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientPaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_payment_method_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'payment_method_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
