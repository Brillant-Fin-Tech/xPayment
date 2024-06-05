@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientPaymentMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.client-payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPaymentMethod.fields.id') }}
                        </th>
                        <td>
                            {{ $clientPaymentMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPaymentMethod.fields.name') }}
                        </th>
                        <td>
                            {{ $clientPaymentMethod->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPaymentMethod.fields.client') }}
                        </th>
                        <td>
                            {{ $clientPaymentMethod->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPaymentMethod.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $clientPaymentMethod->payment_method->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.client-payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
