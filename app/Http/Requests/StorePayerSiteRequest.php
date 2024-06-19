<?php

namespace App\Http\Requests;

use App\Models\PayerSite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePayerSiteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payer_site_create');
    }

    public function rules()
    {
        return [
            'currency_code' => [
                'string',
                'required',
            ],
            'wallet_address' => [
                'string',
                'nullable',
            ],
            'base_currency_code' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'customer_kyc' => [
                'string',
                'nullable',
            ],
            'external_customer' => [
                'string',
                'nullable',
            ],
            'response_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
