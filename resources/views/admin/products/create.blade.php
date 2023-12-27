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

                <div class="mb-3 mx-2">
                    <label for="price" class="text-xs required">{{ trans('cruds.product.fields.price') }}</label>
                    <div class="form-group">
                        <input type="number" id="price" name="price" class="{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
                    </div>
                    @if($errors->has('price'))
                        <p class="invalid-feedback">{{ $errors->first('price') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="stock_quantity" class="text-xs required">{{ trans('cruds.product.fields.stock_quantity') }}</label>
                    <div class="form-group">
                        <input type="number" id="stock_quantity" name="stock_quantity" class="{{ $errors->has('stock_quantity') ? ' is-invalid' : '' }}" value="{{ old('stock_quantity') }}" required>
                    </div>
                    @if($errors->has('stock_quantity'))
                        <p class="invalid-feedback">{{ $errors->first('stock_quantity') }}</p>
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
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
