@extends('dash.layout.app')
@section('title', __('main.create.category'))
@section('main_folder', __('main.categories'))
@section('sub_folder', __('main.create.category'))
@section('content')
<form action="{{ route('dash.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-0 mt-lg-0 mt-2" id="submit-all">@lang('main.save')</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h5 class="font-weight-bolder mb-0">@lang('main.create.category')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label>@lang('main.en.name')</label>
                            <input class="form-control" name="name[en]" type="text" value="{{ old('name.en') }}" />
                            @error('name.en')
                            <div class=" text  text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label>@lang('main.ar.name')</label>
                            <input class="form-control" name="name[ar]" type="text" value="{{ old('name.ar') }}" />
                            @error('name.ar')
                            <div class=" text  text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection