@can('client_site_token_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.client-site-tokens.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.clientSiteToken.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clientSiteToken.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clientSiteClientSiteTokens">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.token') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.expires_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientSiteToken.fields.client_site') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientSiteTokens as $key => $clientSiteToken)
                        <tr data-entry-id="{{ $clientSiteToken->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $clientSiteToken->id ?? '' }}
                            </td>
                            <td>
                                {{ $clientSiteToken->token ?? '' }}
                            </td>
                            <td>
                                {{ $clientSiteToken->expires_at ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\ClientSiteToken::IS_ACTIVE_SELECT[$clientSiteToken->is_active] ?? '' }}
                            </td>
                            <td>
                                {{ $clientSiteToken->client_site->domain ?? '' }}
                            </td>
                            <td>
                                @can('client_site_token_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.client-site-tokens.show', $clientSiteToken->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('client_site_token_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.client-site-tokens.edit', $clientSiteToken->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('client_site_token_delete')
                                    <form action="{{ route('admin.client-site-tokens.destroy', $clientSiteToken->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('client_site_token_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.client-site-tokens.massDestroy') }}",
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
  let table = $('.datatable-clientSiteClientSiteTokens:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection