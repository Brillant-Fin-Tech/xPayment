<?php

namespace App\Http\Requests;

use App\Models\PayerSite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPayerSiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('payer_site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:payer_sites,id',
        ];
    }
}
