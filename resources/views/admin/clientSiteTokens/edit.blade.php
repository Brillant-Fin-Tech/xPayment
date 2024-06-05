@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.clientSiteToken.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-site-tokens.update", [$clientSiteToken->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="token">{{ trans('cruds.clientSiteToken.fields.token') }}</label>
                <input class="form-control {{ $errors->has('token') ? 'is-invalid' : '' }}" type="text" name="token" id="token" value="{{ old('token', $clientSiteToken->token) }}" required>
                @if($errors->has('token'))
                    <div class="invalid-feedback">
                        {{ $errors->first('token') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSiteToken.fields.token_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expires_at">{{ trans('cruds.clientSiteToken.fields.expires_at') }}</label>
                <input class="form-control datetime {{ $errors->has('expires_at') ? 'is-invalid' : '' }}" type="text" name="expires_at" id="expires_at" value="{{ old('expires_at', $clientSiteToken->expires_at) }}" required>
                @if($errors->has('expires_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expires_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSiteToken.fields.expires_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.clientSiteToken.fields.is_active') }}</label>
                <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                    <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ClientSiteToken::IS_ACTIVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('is_active', $clientSiteToken->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSiteToken.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_site_id">{{ trans('cruds.clientSiteToken.fields.client_site') }}</label>
                <select class="form-control select2 {{ $errors->has('client_site') ? 'is-invalid' : '' }}" name="client_site_id" id="client_site_id">
                    @foreach($client_sites as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_site_id') ? old('client_site_id') : $clientSiteToken->client_site->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_site'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_site') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSiteToken.fields.client_site_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection