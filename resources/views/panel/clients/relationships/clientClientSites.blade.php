@can('client_site_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('panel.client-sites.create',["client_id"=>$client->id]) }}">
                {{ trans('global.add') }} {{ trans('cruds.clientSite.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clientSite.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clientClientSites">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.clientSite.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSite.fields.domain') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSite.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSite.fields.payment_method') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientSites as $key => $clientSite)
                        <tr data-entry-id="{{ $clientSite->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $clientSite->id ?? '' }}
                            </td>
                            <td>
                                {{ $clientSite->domain ?? '' }}
                            </td>
                            <td>
                                {{ $clientSite->client->name ?? '' }}
                            </td>
                            <td>
                                @foreach($clientSite->payment_methods as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('client_site_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('panel.client-sites.show', $clientSite->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('client_site_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('panel.client-sites.edit', $clientSite->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('client_site_delete')
                                    <form action="{{ route('panel.client-sites.destroy', $clientSite->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('client_site_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('panel.client-sites.massDestroy') }}",
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
  let table = $('.datatable-clientClientSites:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
