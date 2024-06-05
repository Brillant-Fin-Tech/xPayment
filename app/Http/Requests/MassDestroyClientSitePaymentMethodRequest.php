<?php

namespace App\Http\Requests;

use App\Models\ClientSitePaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientSitePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_site_payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_site_payment_methods,id',
        ];
    }
}
