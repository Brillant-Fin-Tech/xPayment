@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientSite.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-sites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSite.fields.id') }}
                        </th>
                        <td>
                            {{ $clientSite->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSite.fields.domain') }}
                        </th>
                        <td>
                            {{ $clientSite->domain }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSite.fields.client') }}
                        </th>
                        <td>
                            {{ $clientSite->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSite.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $clientSite->payment_method->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-sites.index') }}">
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
            <a class="nav-link" href="#client_site_client_site_tokens" role="tab" data-toggle="tab">
                {{ trans('cruds.clientSiteToken.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_site_client_site_tokens">
            @includeIf('admin.clientSites.relationships.clientSiteClientSiteTokens', ['clientSiteTokens' => $clientSite->clientSiteClientSiteTokens])
        </div>
    </div>
</div>

@endsection