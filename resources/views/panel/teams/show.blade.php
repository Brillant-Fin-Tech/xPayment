@extends('layouts.panel')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.team.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.id') }}
                        </th>
                        <td>
                            {{ $team->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.payment_methood') }}
                        </th>
                        <td>
                            @foreach($team->payment_methoods as $key => $payment_methood)
                                <span class="label label-info">{{ $payment_methood->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.name') }}
                        </th>
                        <td>
                            {{ $team->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.owner') }}
                        </th>
                        <td>
                            {{ $team->owner->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('panel.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#reseller_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.transaction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#reseller_payers" role="tab" data-toggle="tab">
                {{ trans('cruds.payer.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="reseller_transactions">
            @includeIf('panel.teams.relationships.resellerTransactions', ['transactions' => $team->resellerTransactions])
        </div>
        <div class="tab-pane" role="tabpanel" id="reseller_payers">
            @includeIf('panel.teams.relationships.resellerPayers', ['payers' => $team->resellerPayers])
        </div>
    </div>
</div>

@endsection
