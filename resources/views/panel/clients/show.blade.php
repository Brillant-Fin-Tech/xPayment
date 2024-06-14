@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.name') }}
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.clients.index') }}">
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
            <a class="nav-link" href="#client_client_payment_methods" role="tab" data-toggle="tab">
                {{ trans('cruds.clientPaymentMethod.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_client_sites" role="tab" data-toggle="tab">
                {{ trans('cruds.clientSite.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_transactionxes" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionx.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_client_payment_methods">
            @includeIf('panel.clients.relationships.clientClientPaymentMethods', ['clientPaymentMethods' => $client->clientClientPaymentMethods])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_client_sites">
            @includeIf('panel.clients.relationships.clientClientSites', ['clientSites' => $client->clientClientSites])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_users">
            @includeIf('panel.clients.relationships.clientUsers', ['users' => $client->clientUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_transactionxes">
            @includeIf('admin.clients.relationships.clientTransactionxes', ['transactionxes' => $client->clientTransactionxes])
        </div>
    </div>
</div>

@endsection
