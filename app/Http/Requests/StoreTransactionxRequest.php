<?php

namespace App\Http\Requests;

use App\Models\Transactionx;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTransactionxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transactionx_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'commission_rate' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'payer_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
