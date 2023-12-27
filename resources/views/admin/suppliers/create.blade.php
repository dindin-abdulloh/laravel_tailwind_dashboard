@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.supplier.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.suppliers.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <div class="mb-3 mx-2">
                    <label for="supplier_name" class="text-xs required">{{ trans('cruds.supplier.fields.supplier_name') }}</label>
                    <div class="form-group">
                        <input type="text" id="supplier_name" name="supplier_name" class="{{ $errors->has('supplier_name') ? ' ' : '' }}" value="{{ old('supplier_name') }}" required>
                    </div>
                    @if($errors->has('supplier_name'))
                        <p class="invalid-feedback">{{ $errors->first('supplier_name') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
                </div>

                <div class="mb-3 mx-2">
                    <label for="supplier_address" class="text-xs required">{{ trans('cruds.supplier.fields.supplier_address') }}</label>
                    <div class="form-group">
                        <input type="text" id="supplier_address" name="supplier_address" class="{{ $errors->has('supplier_address') ? ' ' : '' }}" value="{{ old('supplier_address') }}" required>
                    </div>
                    @if($errors->has('supplier_address'))
                        <p class="invalid-feedback">{{ $errors->first('supplier_address') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="mb-3 mx-2">
                    <label for="supplier_telp" class="text-xs required">{{ trans('cruds.supplier.fields.supplier_telp') }}</label>
                    <div class="form-group">
                        <input type="text" id="supplier_telp" name="supplier_telp" class="{{ $errors->has('supplier_telp') ? ' ' : '' }}" value="{{ old('supplier_telp') }}" required>
                    </div>
                    @if($errors->has('supplier_telp'))
                        <p class="invalid-feedback">{{ $errors->first('supplier_telp') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
