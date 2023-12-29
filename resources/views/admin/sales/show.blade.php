@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.sale.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('admin.sales.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        {{$sale}}
        {{$soldProducts}}
        {{-- <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.sale.fields.id') }}
                    </th>
                    <td>
                        {{ $product->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.sale.fields.name') }}
                    </th>
                    <td>
                        {{ $product->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.users') }}
                    </th>
                    <td>
                        @foreach($product->users as $key => $users)
                            <span class="label label-info">{{ $users->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table> --}}
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('admin.sales.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
