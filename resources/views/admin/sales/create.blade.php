@extends('layouts.admin')
@section('content')
@php
    $user = Auth::user()->id;
@endphp
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.sale.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.sales.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <input type="hidden" name="user_id" value="{{$user}}" id="">
                <div class="mb-3 mx-2">
                    <label for="product_id" class="text-xs required">{{ trans('cruds.sale.fields.product_id') }}</label>
                    <select class="select2 {{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id" id="product_id" multiple>
                        @foreach($products as $prod)
                            <option data-price="{{$prod->price}}" value="{{ $prod->id }}" {{ old('product_id', '') ? 'selected' : '' }}>
                                {{ $prod->product_name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('product_id'))
                        <p class="invalid-feedback">{{ $errors->first('product_id') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="quantity" class="text-xs required">{{ trans('cruds.sale.fields.quantity') }}</label>
                    <div class="form-group">
                        <input type="number" id="quantity" name="quantity" class="{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') }}" required>
                    </div>
                    @if($errors->has('quantity'))
                        <p class="invalid-feedback">{{ $errors->first('quantity') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="sale_date" class="text-xs required">{{ trans('cruds.sale.fields.sale_date') }}</label>
                    <div class="form-group">
                        <input type="date" id="sale_date" name="sale_date" class="{{ $errors->has('sale_date') ? ' is-invalid' : '' }}" value="{{ old('sale_date', date('Y-m-d')) }}" required>
                    </div>
                    @if($errors->has('sale_date'))
                        <p class="invalid-feedback">{{ $errors->first('sale_date') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="mb-3 mx-2">
                    <label for="unit_price" class="text-xs required">{{ trans('cruds.sale.fields.unit_price') }}</label>
                    <div class="form-group">
                        <input type="number" id="unit_price" name="unit_price" class="{{ $errors->has('unit_price') ? ' is-invalid' : '' }}" value="{{ old('unit_price') }}" required>
                    </div>
                    @if($errors->has('unit_price'))
                        <p class="invalid-feedback">{{ $errors->first('unit_price') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="discount" class="text-xs required">{{ trans('cruds.sale.fields.discount') }}</label>
                    <div class="form-group">
                        <input  type="number" id="discount" name="discount" class="{{ $errors->has('discount') ? ' is-invalid' : '' }}" value="{{ old('discount') }}" readonly>
                    </div>
                    @if($errors->has('discount'))
                        <p class="invalid-feedback">{{ $errors->first('discount') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="total_amount" class="text-xs required">{{ trans('cruds.sale.fields.total_amount') }}</label>
                    <div class="form-group">
                        <input type="number" id="total_amount" name="total_amount" class="{{ $errors->has('total_amount') ? ' is-invalid' : '' }}" value="{{ old('total_amount') }}" readonly required>
                    </div>
                    @if($errors->has('total_amount'))
                        <p class="invalid-feedback">{{ $errors->first('total_amount') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@parent
<script>
   $(document).ready(function() {
        $('#product_id').change(function() {
            var selectedProductId = $(this).val();

            if (selectedProductId && selectedProductId.length > 0) {
                var selectedProductPrice = $('#product_id option[value="' + selectedProductId[0] + '"]').data('price');
                $('#unit_price').val(selectedProductPrice);
            }
        });

        $('#product_id, #quantity').on('input', function() {
            updateTotalAmount();
        });

        function updateTotalAmount() {
            var selectedProductId = $('#product_id').val();
            var selectedProductPrice = selectedProductId ? $('#product_id option[value="' + selectedProductId[0] + '"]').data('price') : 0;
            var quantity = $('#quantity').val();

           var totalAmount = selectedProductPrice * quantity;


            var discount = (quantity >= 10) ? 0.02 * totalAmount : 0;

            discount = parseFloat(discount.toFixed(2));


            $('#discount').val(discount);


            $('#total_amount').val(totalAmount - discount);
        }

    });
</script>
@endsection
