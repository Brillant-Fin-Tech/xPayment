@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.name') }}
                        </th>
                        <td>
                            {{ $paymentMethod->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#payment_method_client_payment_methods" role="tab" data-toggle="tab">
                {{ trans('cruds.clientPaymentMethod.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#payment_method_transactionxes" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionx.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#payment_method_client_sites" role="tab" data-toggle="tab">
                {{ trans('cruds.clientSite.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="payment_method_client_payment_methods">
            @includeIf('panel.paymentMethods.relationships.paymentMethodClientPaymentMethods', ['clientPaymentMethods' => $paymentMethod->paymentMethodClientPaymentMethods])
        </div>
        <div class="tab-pane" role="tabpanel" id="payment_method_transactionxes">
            @includeIf('admin.paymentMethods.relationships.paymentMethodTransactionxes', ['transactionxes' => $paymentMethod->paymentMethodTransactionxes])
        </div>
        <div class="tab-pane" role="tabpanel" id="payment_method_client_sites">
            @includeIf('panel.paymentMethods.relationships.paymentMethodClientSites', ['clientSites' => $paymentMethod->paymentMethodClientSites])
        </div>
    </div>
</div>

@endsection
