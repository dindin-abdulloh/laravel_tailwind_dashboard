@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.supplier.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('admin.supplier.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.supplier.fields.id') }}
                    </th>
                    <td>
                        {{ $suppliers->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.supplier.fields.supplier_name') }}
                    </th>
                    <td>
                        {{ $suppliers->supplier_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.supplier.fields.supplier_address') }}
                    </th>
                    <td>
                        {{ $suppliers->supplier_address }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.supplier.fields.supplier_telp') }}
                    </th>
                    <td>
                        {{ $suppliers->supplier_telp }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('admin.categories.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
