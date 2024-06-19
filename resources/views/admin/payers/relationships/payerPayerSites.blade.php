@can('payer_site_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payer-sites.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.payerSite.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.payerSite.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-payerPayerSites">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.currency_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.wallet_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.base_currency_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.customer_kyc') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.external_customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.response_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.payer') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.site') }}
                        </th>
                        <th>
                            {{ trans('cruds.payerSite.fields.payment_method') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payerSites as $key => $payerSite)
                        <tr data-entry-id="{{ $payerSite->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $payerSite->id ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->currency_code ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->wallet_address ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->base_currency_code ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->email ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->phone ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->customer_kyc ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->external_customer ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->response_url ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->payer->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->site->domain ?? '' }}
                            </td>
                            <td>
                                {{ $payerSite->payment_method->name ?? '' }}
                            </td>
                            <td>
                                @can('payer_site_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payer-sites.show', $payerSite->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payer_site_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payer-sites.edit', $payerSite->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('payer_site_delete')
                                    <form action="{{ route('admin.payer-sites.destroy', $payerSite->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('payer_site_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payer-sites.massDestroy') }}",
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
  let table = $('.datatable-payerPayerSites:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection