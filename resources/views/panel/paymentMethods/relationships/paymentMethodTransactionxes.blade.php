@can('transactionx_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transactionxes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionx.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionx.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-paymentMethodTransactionxes">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.commission_rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.commission') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.amount_net') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.payer') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.payment_method') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.site') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionx.fields.client') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionxes as $key => $transactionx)
                        <tr data-entry-id="{{ $transactionx->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transactionx->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Transactionx::TYPE_SELECT[$transactionx->type] ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->amount ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->commission_rate ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->commission ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->amount_net ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->date ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->payer->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->payment_method->name ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->site->domain ?? '' }}
                            </td>
                            <td>
                                {{ $transactionx->client->name ?? '' }}
                            </td>
                            <td>
                                @can('transactionx_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transactionxes.show', $transactionx->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('transactionx_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transactionxes.edit', $transactionx->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('transactionx_delete')
                                    <form action="{{ route('admin.transactionxes.destroy', $transactionx->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transactionx_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transactionxes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-paymentMethodTransactionxes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection