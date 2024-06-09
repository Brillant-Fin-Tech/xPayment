@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientSite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("panel.client-sites.store") }}" enctype="multipart/form-data">
            @csrf
            <input  name="client_id" value="{{ request()->input('client') }}" type="hidden">

            <div class="form-group">
                <label for="domain">{{ trans('cruds.clientSite.fields.domain') }}</label>
                <input class="form-control {{ $errors->has('domain') ? 'is-invalid' : '' }}" type="text" name="domain" id="domain" value="{{ old('domain', '') }}">
                @if($errors->has('domain'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domain') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSite.fields.domain_helper') }}</span>
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
