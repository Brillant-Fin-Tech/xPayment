<?php

namespace App\Http\Requests;

use App\Models\ClientSiteToken;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientSiteTokenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_site_token_create');
    }

    public function rules()
    {
        return [
            'token' => [
                'string',
                'unique:client_site_tokens',
            ],
            'expires_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
