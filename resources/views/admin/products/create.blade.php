@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <div class="mb-3 mx-2">
                    <label for="product_name" class="text-xs required">{{ trans('cruds.product.fields.product_name') }}</label>
                    <div class="form-group">
                        <input type="text" id="product_name" name="product_name" class="{{ $errors->has('product_name') ? ' is-invalid' : '' }}" value="{{ old('product_name') }}" required>
                    </div>
                    @if($errors->has('product_name'))
                        <p class="invalid-feedback">{{ $errors->first('product_name') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="purchase_price" class="text-xs required">{{ trans('cruds.product.fields.purchase_price') }}</label>
                    <div class="form-group">
                        <input type="number" id="purchase_price" name="purchase_price" class="{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}" value="{{ old('purchase_price') }}" required>
                    </div>
                    @if($errors->has('purchase_price'))
                        <p class="invalid-feedback">{{ $errors->first('purchase_price') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="stock_quantity" class="text-xs required">{{ trans('cruds.product.fields.stock_quantity') }}</label>
                    <div class="form-group">
                        <input type="number" id="stock_quantity" name="stock_quantity" class="{{ $errors->has('stock_quantity') ? ' is-invalid' : '' }}" value="{{ old('stock_quantity') }}" required>
                    </div>
                    @if($errors->has('stock_quantity'))
                        <p class="invalid-feedback">{{ $errors->first('stock_quantity') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="product_code" class="text-xs required">{{ trans('cruds.product.fields.product_code') }}</label>
                    <div class="form-group">
                        <input type="text" id="product_code" name="product_code" class="{{ $errors->has('product_code') ? ' is-invalid' : '' }}" value="{{ old('product_code') }}" required>
                    </div>
                    @if($errors->has('product_code'))
                        <p class="invalid-feedback">{{ $errors->first('product_code') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="unit_id" class="text-xs">{{ trans('cruds.product.fields.unit_type') }}</label>
                    <select class="select2{{ $errors->has('unit_id') ? ' is-invalid' : '' }}" name="unit_id" id="unit_id" multiple>
                        @foreach($unit as $id => $unt)
                            <option value="{{ $id }}" {{ old('unit_id', '') == $id ? 'selected' : '' }}>{{ $unt }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('unit_id'))
                        <p class="invalid-feedback">{{ $errors->first('unit_id') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="mt-3 mx-2">
                    <label for="category_id" class="text-xs">{{ trans('cruds.product.fields.category') }}</label>
                    <select class="select2{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" id="category_id" multiple>
                        @foreach($category as $id => $cat)
                            <option value="{{ $id }}" {{ old('category_id', '') == $id ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <p class="invalid-feedback">{{ $errors->first('category_id') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="price" class="text-xs required">{{ trans('cruds.product.fields.price') }}</label>
                    <div class="form-group">
                        <input type="number" id="price" name="price" class="{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
                    </div>
                    @if($errors->has('price'))
                        <p class="invalid-feedback">{{ $errors->first('price') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mt-3 mx-2">
                    <label for="supplier_id" class="text-xs">{{ trans('cruds.product.fields.supplier') }}</label>
                    <select class="select2{{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" name="supplier_id" id="supplier_id" multiple>
                        @foreach($supplier as $id => $sup)
                            <option value="{{ $id }}" {{  old('supplier_id', '')? 'selected' : '' }}>{{ $sup }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('supplier_id'))
                        <p class="invalid-feedback">{{ $errors->first('supplier_id') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>
                <div class="mt-3 mx-2">
                    <label for="expired_date" class="text-xs required">{{ trans('cruds.product.fields.expired_date') }}</label>
                    <div class="form-group">
                        <input type="date" id="expired_date" name="expired_date" class="{{ $errors->has('expired_date') ? ' is-invalid' : '' }}" value="{{ old('expired_date') }}" required>
                    </div>
                    @if($errors->has('expired_date'))
                        <p class="invalid-feedback">{{ $errors->first('expired_date') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
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
         $(document).ready(function () {
            var $purchasePriceInput = $('#purchase_price');
            var $priceInput = $('#price');
            var $productNameInput = $('#product_name');
            var $productCodeInput = $('#product_code');

            $purchasePriceInput.on('input', function () {
                var purchasePrice = parseFloat($purchasePriceInput.val());

                if (!isNaN(purchasePrice)) {
                    var calculatedPrice = purchasePrice * 1.25;
                    $priceInput.val(calculatedPrice.toFixed(2));
                }
            });


            function generateProductCode() {

                var productName = $productNameInput.val();


                if (productName.length >= 3) {

                    var prefix = productName.substring(0, 3).toUpperCase();


                    var randomDigits = Math.floor(10000 + Math.random() * 90000);

                    var generatedProductCode = prefix + randomDigits;

                    $productCodeInput.val(generatedProductCode);
                }
            }

            $productNameInput.on('input', function () {
                generateProductCode();
            });
        });
    </script>
@endsection
