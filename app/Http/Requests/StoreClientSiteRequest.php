<?php

namespace App\Http\Requests;

use App\Models\ClientSite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientSiteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_site_create');
    }

    public function rules()
    {
        return [
            'domain' => [
                'string',
                'nullable',
            ],
            'payment_methods.*' => [
                'integer',
            ],
            'payment_methods' => [
                'array',
            ],
        ];
    }
}
