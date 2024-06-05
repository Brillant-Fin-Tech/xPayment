<?php

namespace App\Http\Requests;

use App\Models\ClientSitePaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientSitePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_site_payment_method_create');
    }

    public function rules()
    {
        return [];
    }
}
