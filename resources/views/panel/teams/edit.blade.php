@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.team.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teams.update", [$team->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="payment_methoods">{{ trans('cruds.team.fields.payment_methood') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('payment_methoods') ? 'is-invalid' : '' }}" name="payment_methoods[]" id="payment_methoods" multiple>
                    @foreach($payment_methoods as $id => $payment_methood)
                        <option value="{{ $id }}" {{ (in_array($id, old('payment_methoods', [])) || $team->payment_methoods->contains($id)) ? 'selected' : '' }}>{{ $payment_methood }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_methoods'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_methoods') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.payment_methood_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.team.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $team->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.name_helper') }}</span>
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
