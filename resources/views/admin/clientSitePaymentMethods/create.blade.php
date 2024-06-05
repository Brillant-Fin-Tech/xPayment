@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientSitePaymentMethod.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-site-payment-methods.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_payment_method_id">{{ trans('cruds.clientSitePaymentMethod.fields.client_payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('client_payment_method') ? 'is-invalid' : '' }}" name="client_payment_method_id" id="client_payment_method_id">
                    @foreach($client_payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_payment_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSitePaymentMethod.fields.client_payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_site_id">{{ trans('cruds.clientSitePaymentMethod.fields.client_site') }}</label>
                <select class="form-control select2 {{ $errors->has('client_site') ? 'is-invalid' : '' }}" name="client_site_id" id="client_site_id">
                    @foreach($client_sites as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_site_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_site'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_site') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientSitePaymentMethod.fields.client_site_helper') }}</span>
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