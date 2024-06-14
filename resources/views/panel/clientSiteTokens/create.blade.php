@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientSiteToken.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("panel.client-site-tokens.store") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="client_site_id" value="{{ request()->input('client_site_id') }}">

            <div class="form-group">
                <label class="required" for="expires_at">{{ trans('cruds.clientSiteToken.fields.expires_at') }}</label>
                <input class="form-control datetime {{ $errors->has('expires_at') ? 'is-invalid' : '' }}" type="text" name="expires_at" id="expires_at" value="{{ old('expires_at') ?? '2030-01-01 00:00:00' }}" required>
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
                        <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
