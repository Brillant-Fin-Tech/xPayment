<?php

namespace App\Http\Requests;

use App\Models\ClientSiteToken;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientSiteTokenRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_site_token_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_site_tokens,id',
        ];
    }
}
