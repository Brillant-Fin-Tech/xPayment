@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientPaymentMethod.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("panel.client-payment-methods.store") }}" enctype="multipart/form-data">
            @csrf
            <input  name="client_id" value="{{ request()->input('client') }}" type="hidden">
            <div class="form-group">
                <label class="required" for="payment_method_id">{{ trans('cruds.clientPaymentMethod.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id" required>
                    @foreach($payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ old('payment_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPaymentMethod.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.add') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
