@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('admin.products.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.id') }}
                    </th>
                    <td>
                        {{ $product->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.product_name') }}
                    </th>
                    <td>
                        {{ $product->product_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.price') }}
                    </th>
                    <td>
                        {{ $product->price }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.stock_quantity') }}
                    </th>
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
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.product.fields.expired_date') }}
                    </th>
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
                </tr>

            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('admin.products.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
