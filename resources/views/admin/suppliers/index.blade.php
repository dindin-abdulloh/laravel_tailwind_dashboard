@extends('layouts.admin')
@section('content')
@can('suppliers_create')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('admin.suppliers.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.supplier.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.supplier.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-Project">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.supplier.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplier.fields.supplier_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplier.fields.supplier_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplier.fields.supplier_telp') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $key => $supplier)
                        <tr data-entry-id="{{ $supplier->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $supplier->id ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->supplier_name ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->supplier_address ?? '' }}
                            </td>
                            <td>
                                {{ $supplier->supplier_telp ?? '' }}
                            </td>
                            {{-- <td>
                                @foreach($category->users as $key => $item)
                                    <span class="badge blue">{{ $item->name }}</span>
                                @endforeach
                            </td> --}}
                            <td>
                                @can('sippliers_show')
                                    <a class="btn-sm btn-indigo" href="{{ route('admin.suppliers.show', $supplier->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sippliers_edit')
                                    <a class="btn-sm btn-blue" href="{{ route('admin.suppliers.edit', $supplier->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sippliers_delete')
                                    <form action="{{ route('admin.sippliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn-sm btn-red" value="{{ trans('global.delete') }}">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('categories_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.massDestroy') }}",
    className: 'btn-red',
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
  let table = $('.datatable-Project:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
