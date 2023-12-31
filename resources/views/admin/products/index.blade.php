@extends('layouts.admin')
@section('content')
@can('products_create')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('admin.products.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
        </a>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-Project">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.product.fields.no') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.product_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.stock_quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.expired_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $product->product_name ?? '' }}
                            </td>
                            <td>
                                {{ $product->price ?? '' }}
                            </td>
                            <td>
                                @if($product->stock_quantity > 10)
                                    <span style="color: green;">
                                        <strong>{{ $product->stock_quantity }}</strong>
                                    </span>
                                @elseif($product->stock_quantity <= 10 && $product->stock_quantity > 5)
                                    <span style="color: rgb(220, 154, 30);">
                                        <strong>{{ $product->stock_quantity }}</strong>
                                    </span>
                                @else
                                    <span style="color: red;">
                                        <strong>{{ $product->stock_quantity }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $product->category->category_name ?? '' }}
                            </td>
                            <td>
                                {{ $product->supplier->supplier_name ?? '' }}
                            </td>
                            <td>
                                @if(isset($product->expired_date))
                                    @php
                                        $expiredDate = \Carbon\Carbon::createFromFormat('Y-m-d', $product->expired_date);
                                        $daysRemaining = now()->diffInDays($expiredDate, false);
                                    @endphp

                                    @if($daysRemaining > 30)
                                        <strong style="color: green;">
                                            {{ $product->expired_date }}
                                        </strong>
                                    @elseif($daysRemaining <= 30 && $daysRemaining > 0)
                                        <strong style="color: rgb(220, 154, 30);">
                                            {{ $product->expired_date }}
                                        </strong>
                                    @else
                                        <strong style="color: red;">
                                            {{ $product->expired_date }}
                                        </strong>
                                    @endif
                                @else
                                    {{ $product->expired_date ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('products_show')
                                    <a class="btn-sm btn-indigo" href="{{ route('admin.products.show', $product->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('products_edit')
                                    <a class="btn-sm btn-blue" href="{{ route('admin.products.edit', $product->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('products_delete')
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('products_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
