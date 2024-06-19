@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.payers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.id') }}
                        </th>
                        <td>
                            {{ $payer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $payer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.last_name') }}
                        </th>
                        <td>
                            {{ $payer->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.phone') }}
                        </th>
                        <td>
                            {{ $payer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.sumsub_token') }}
                        </th>
                        <td>
                            {{ $payer->sumsub_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payer.fields.email') }}
                        </th>
                        <td>
                            {{ $payer->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.payers.index') }}">
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
            <a class="nav-link" href="#payer_transactionxes" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionx.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#payer_payer_sites" role="tab" data-toggle="tab">
                {{ trans('cruds.payerSite.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="payer_transactionxes">
            @includeIf('panel.payers.relationships.payerTransactionxes', ['transactionxes' => $payer->payerTransactionxes])
        </div>
        <div class="tab-pane" role="tabpanel" id="payer_payer_sites">
            @includeIf('panel.payers.relationships.payerPayerSites', ['payerSites' => $payer->payerPayerSites])
        </div>
    </div>
</div>

@endsection
