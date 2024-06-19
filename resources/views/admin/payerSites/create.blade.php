@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.payerSite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payer-sites.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="currency_code">{{ trans('cruds.payerSite.fields.currency_code') }}</label>
                <input class="form-control {{ $errors->has('currency_code') ? 'is-invalid' : '' }}" type="text" name="currency_code" id="currency_code" value="{{ old('currency_code', '') }}" required>
                @if($errors->has('currency_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('currency_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.currency_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wallet_address">{{ trans('cruds.payerSite.fields.wallet_address') }}</label>
                <input class="form-control {{ $errors->has('wallet_address') ? 'is-invalid' : '' }}" type="text" name="wallet_address" id="wallet_address" value="{{ old('wallet_address', '') }}">
                @if($errors->has('wallet_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wallet_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.wallet_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="base_currency_code">{{ trans('cruds.payerSite.fields.base_currency_code') }}</label>
                <input class="form-control {{ $errors->has('base_currency_code') ? 'is-invalid' : '' }}" type="text" name="base_currency_code" id="base_currency_code" value="{{ old('base_currency_code', '') }}">
                @if($errors->has('base_currency_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('base_currency_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.base_currency_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.payerSite.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.payerSite.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_kyc">{{ trans('cruds.payerSite.fields.customer_kyc') }}</label>
                <input class="form-control {{ $errors->has('customer_kyc') ? 'is-invalid' : '' }}" type="text" name="customer_kyc" id="customer_kyc" value="{{ old('customer_kyc', '') }}">
                @if($errors->has('customer_kyc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_kyc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.customer_kyc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="external_customer">{{ trans('cruds.payerSite.fields.external_customer') }}</label>
                <input class="form-control {{ $errors->has('external_customer') ? 'is-invalid' : '' }}" type="text" name="external_customer" id="external_customer" value="{{ old('external_customer', '') }}">
                @if($errors->has('external_customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('external_customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.external_customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_url">{{ trans('cruds.payerSite.fields.response_url') }}</label>
                <input class="form-control {{ $errors->has('response_url') ? 'is-invalid' : '' }}" type="text" name="response_url" id="response_url" value="{{ old('response_url', '') }}">
                @if($errors->has('response_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.response_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payer_id">{{ trans('cruds.payerSite.fields.payer') }}</label>
                <select class="form-control select2 {{ $errors->has('payer') ? 'is-invalid' : '' }}" name="payer_id" id="payer_id">
                    @foreach($payers as $id => $entry)
                        <option value="{{ $id }}" {{ old('payer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.payer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="site_id">{{ trans('cruds.payerSite.fields.site') }}</label>
                <select class="form-control select2 {{ $errors->has('site') ? 'is-invalid' : '' }}" name="site_id" id="site_id">
                    @foreach($sites as $id => $entry)
                        <option value="{{ $id }}" {{ old('site_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('site'))
                    <div class="invalid-feedback">
                        {{ $errors->first('site') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.site_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method_id">{{ trans('cruds.payerSite.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id">
                    @foreach($payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ old('payment_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payerSite.fields.payment_method_helper') }}</span>
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