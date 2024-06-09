@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("panel.transactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.transaction.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Transaction::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commission_rate">{{ trans('cruds.transaction.fields.commission_rate') }}</label>
                <input class="form-control {{ $errors->has('commission_rate') ? 'is-invalid' : '' }}" type="number" name="commission_rate" id="commission_rate" value="{{ old('commission_rate', '') }}" step="0.01" max="100">
                @if($errors->has('commission_rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commission_rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.commission_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commission">{{ trans('cruds.transaction.fields.commission') }}</label>
                <input class="form-control {{ $errors->has('commission') ? 'is-invalid' : '' }}" type="number" name="commission" id="commission" value="{{ old('commission', '') }}" step="0.01">
                @if($errors->has('commission'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commission') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_net">{{ trans('cruds.transaction.fields.amount_net') }}</label>
                <input class="form-control {{ $errors->has('amount_net') ? 'is-invalid' : '' }}" type="number" name="amount_net" id="amount_net" value="{{ old('amount_net', '') }}" step="0.01">
                @if($errors->has('amount_net'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_net') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_net_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payer_id">{{ trans('cruds.transaction.fields.payer') }}</label>
                <select class="form-control select2 {{ $errors->has('payer') ? 'is-invalid' : '' }}" name="payer_id" id="payer_id" required>
                    @foreach($payers as $id => $entry)
                        <option value="{{ $id }}" {{ old('payer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.payer_helper') }}</span>
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
