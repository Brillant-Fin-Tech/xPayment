@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payerSite.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payer-sites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.id') }}
                        </th>
                        <td>
                            {{ $payerSite->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.currency_code') }}
                        </th>
                        <td>
                            {{ $payerSite->currency_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.wallet_address') }}
                        </th>
                        <td>
                            {{ $payerSite->wallet_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.base_currency_code') }}
                        </th>
                        <td>
                            {{ $payerSite->base_currency_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.email') }}
                        </th>
                        <td>
                            {{ $payerSite->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.phone') }}
                        </th>
                        <td>
                            {{ $payerSite->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.customer_kyc') }}
                        </th>
                        <td>
                            {{ $payerSite->customer_kyc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.external_customer') }}
                        </th>
                        <td>
                            {{ $payerSite->external_customer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.response_url') }}
                        </th>
                        <td>
                            {{ $payerSite->response_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.payer') }}
                        </th>
                        <td>
                            {{ $payerSite->payer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.site') }}
                        </th>
                        <td>
                            {{ $payerSite->site->domain ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payerSite.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $payerSite->payment_method->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payer-sites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection