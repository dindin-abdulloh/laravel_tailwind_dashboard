@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="product_name" class="text-xs required">{{ trans('cruds.product.fields.product_name') }}</label>

                <div class="form-group">
                    <input type="text" id="product_name" name="name" class="{{ $errors->has('product_name') ? ' is-invalid' : '' }}" value="{{ old('product_name') }}" required>
                </div>
                @if($errors->has('product_name'))
                    <p class="invalid-feedback">{{ $errors->first('product_name') }}</p>
                @endif
                <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>

            <div class="mb-3">
                <label for="price" class="text-xs required">{{ trans('cruds.product.fields.price') }}</label>

                <div class="form-group">
                    <input type="text" id="price" name="price" class="{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
                </div>
                @if($errors->has('price'))
                    <p class="invalid-feedback">{{ $errors->first('price') }}</p>
                @endif
                <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>

            <div class="mb-3">
                <label for="stock_quantity" class="text-xs required">{{ trans('cruds.product.fields.stock_quantity') }}</label>

                <div class="form-group">
                    <input type="text" id="stock_quantity" name="stock_quantity" class="{{ $errors->has('stock_quantity') ? ' is-invalid' : '' }}" value="{{ old('stock_quantity') }}" required>
                </div>
                @if($errors->has('stock_quantity'))
                    <p class="invalid-feedback">{{ $errors->first('stock_quantity') }}</p>
                @endif
                <span class="block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>

            <div class="mb-3">
                <label for="users" class="text-xs">{{ trans('cruds.project.fields.users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn-sm btn-indigo select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn-sm btn-indigo deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="select2{{ $errors->has('users') ? ' is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $users)
                        <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $users }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <p class="invalid-feedback">{{ $errors->first('users') }}</p>
                @endif
                <span class="block">{{ trans('cruds.project.fields.users_helper') }}</span>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
