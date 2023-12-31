@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="category_name" class="text-xs required">{{ trans('cruds.category.fields.category_name') }}</label>

                <div class="form-group">
                    <input type="text" id="category_name" name="category_name" class="{{ $errors->has('title') ? ' ' : '' }}" value="{{ old('category_name', $category->category_name) }}" required>
                </div>
                @if($errors->has('category_name'))
                    <p class="invalid-feedback">{{ $errors->first('category_name') }}</p>
                @endif
                <span class="block">{{ trans('cruds.category.fields.name_helper') }}</span>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
