<?php

namespace App\Http\Requests;

use App\Models\ClientSite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientSiteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_site_edit');
    }

    public function rules()
    {
        return [
            'domain' => [
                'string',
                'nullable',
            ],
        ];
    }
}
