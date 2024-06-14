@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientSite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("panel.client-sites.store") }}" enctype="multipart/form-data">
            @csrf
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
            <input name="client_id" value="{{ request()->input('client_id') }}">
            <div class="form-group">
                <label for="payment_methods">{{ trans('cruds.clientSite.fields.payment_method') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('payment_methods') ? 'is-invalid' : '' }}" name="payment_methods[]" id="payment_methods" multiple>
                    @foreach($payment_methods as $id => $payment_method)
                        <option value="{{ $id }}" {{ in_array($id, old('payment_methods', [])) ? 'selected' : '' }}>{{ $payment_method }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_methods'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_methods') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSite.fields.payment_method_helper') }}</span>
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
