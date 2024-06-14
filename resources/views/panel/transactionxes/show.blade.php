@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionx.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.transactionxes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.id') }}
                        </th>
                        <td>
                            {{ $transactionx->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Transactionx::TYPE_SELECT[$transactionx->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.amount') }}
                        </th>
                        <td>
                            {{ $transactionx->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.commission_rate') }}
                        </th>
                        <td>
                            {{ $transactionx->commission_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.commission') }}
                        </th>
                        <td>
                            {{ $transactionx->commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.amount_net') }}
                        </th>
                        <td>
                            {{ $transactionx->amount_net }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.date') }}
                        </th>
                        <td>
                            {{ $transactionx->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.payer') }}
                        </th>
                        <td>
                            {{ $transactionx->payer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $transactionx->payment_method->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.site') }}
                        </th>
                        <td>
                            {{ $transactionx->site->domain ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionx.fields.client') }}
                        </th>
                        <td>
                            {{ $transactionx->client->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.transactionxes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
