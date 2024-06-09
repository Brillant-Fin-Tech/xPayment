@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientSiteToken.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.client-site-tokens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.id') }}
                        </th>
                        <td>
                            {{ $clientSiteToken->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.token') }}
                        </th>
                        <td>
                            {{ $clientSiteToken->token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.expires_at') }}
                        </th>
                        <td>
                            {{ $clientSiteToken->expires_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\ClientSiteToken::IS_ACTIVE_SELECT[$clientSiteToken->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.client_site') }}
                        </th>
                        <td>
                            {{ $clientSiteToken->client_site->domain ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.client-site-tokens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
