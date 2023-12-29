@extends('layouts.admin')
@section('content')
    @can('sales_create')
        <div class="block my-4">
            <a class="btn-md btn-green" href="{{ route('admin.sales.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sale.title_singular') }}
            </a>
        </div>
    @endcan
    <div class="main-card">
        <div class="header">
            {{ trans('cruds.sale.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="body">
            <div class="w-full">
                <table class="stripe hover bordered datatable datatable-Project">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.sale_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.transaction_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.grand_total') }}
                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.amount_paid') }}
                            </th>
                            <th>
                                {{ trans('cruds.sale.fields.change_due') }}
                            </th>

                            <th>
                                {{ trans('cruds.sale.fields.user') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $sale)
                            <tr data-entry-id="{{ $sale->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $sale->id ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->sale_date ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->transaction_code ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->grand_total ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->amount_paid ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->change_due ?? '' }}
                                </td>
                                <td>
                                    {{ $sale->user->name ?? '' }}
                                </td>
                                <td>
                                    {{-- @can('sales_show')
                                    <a class="btn-sm btn-indigo" href="{{ route('admin.sales.show', $sale->id) }}">
                                        {{ trans('global.print') }}
                                    </a>
                                @endcan --}}
                                    @can('sales_show')
                                        <a class="btn-sm btn-indigo" href="javascript:void(0);"
                                            onclick="openPrintPopup('{{ route('admin.sales.show', $sale->id) }}')">
                                            {{ trans('global.print') }}
                                        </a>
                                    @endcan


                                    @can('sales_edit')
                                        <a class="btn-sm btn-blue" href="{{ route('admin.sales.edit', $sale->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('sales_delete')
                                        <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('products_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.products.massDestroy') }}",
                    className: 'btn-red',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Project:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>

    <script>
        function openPrintPopup(pdfUrl) {
            window.open(pdfUrl, '_blank', 'width=600,height=800');
        }
    </script>
@endsection
