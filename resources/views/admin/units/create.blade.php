@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.units.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <div class="mb-3 mx-2">
                    <label for="name" class="text-xs required">{{ trans('cruds.unit.fields.name') }}</label>
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="{{ $errors->has('name') ? ' ' : '' }}" value="{{ old('name') }}" required>
                    </div>
                    @if($errors->has('name'))
                        <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.unit.fields.name_helper') }}</span>
                </div>


            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="mb-3 mx-2">
                    <label for="description" class="text-xs">{{ trans('cruds.unit.fields.description') }}</label>
                    <div class="form-group">
                        <textarea id="description" name="description" class="{{ $errors->has('description') ? ' is-invalid' : '' }} w-full rounded-md border-none focus:outline-none" required>{{ old('description') }}</textarea>
                    </div>
                    @if($errors->has('description'))
                        <p class="invalid-feedback">{{ $errors->first('description') }}</p>
                    @endif
                    <span class="block">{{ trans('cruds.unit.fields.name_helper') }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection
