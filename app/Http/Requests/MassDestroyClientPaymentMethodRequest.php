<?php

namespace App\Http\Requests;

use App\Models\ClientPaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientPaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_payment_methods,id',
        ];
    }
}
