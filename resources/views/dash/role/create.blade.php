@extends('dash.layout.app')
@section('title', __('main.create.role'))
@section('main_folder', __('main.roles'))
@section('sub_folder', __('main.create.role'))
@section('content')
<form action="{{ route('dash.roles.store') }}" method="POST" enctype="multipart/form-data">
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
                    <h5 class="font-weight-bolder mb-0">@lang('main.create.role')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label>@lang('main.name')</label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}" />
                            @error('name')
                            <div class=" text  text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($permissions as $permission)
                        <div class="col-3">
                            <div class="card m-2">
                                <div class="card-body p-3">
                                    <div class="form-check ps-0">
                                        <input model="{{ $permission->first()->model }}"
                                            class="baseCheckbox form-check-input ms-auto" type="checkbox"
                                            id="baseCheck_{{ $permission->first()->model }}">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="baseCheck_{{ $permission->first()->model }}">
                                            <h6>{{ Str::ucfirst($permission->first()->model) }}</h6>
                                        </label>
                                    </div>
                                    <ul style="margin-left:40px" class="list-group">
                                        @foreach ($permission as $modelPermission)
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check  ps-0">
                                                <input name="permissions[]" model="{{ $permission->first()->model }}"
                                                    @checked(in_array($modelPermission->name, old('permissions',
                                                [])))
                                                class="baseCheck_{{ $permission->first()->model }} checkInput
                                                form-check-input ms-auto"
                                                type="checkbox" id="{{ $modelPermission->id }}"
                                                value="{{ $modelPermission->name }}">
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                    for="{{ $modelPermission->id }}">
                                                    @lang('main.' . str_replace('_', '.', $modelPermission->name))
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('script')
<script>
    $(document).ready(function() {

            function checkBase() {
                $('.checkInput').each(function() {
                    let model = $(this).attr('model');
                    let checked = true;
                    $('.baseCheck_' + model).each(function() {
                        if (!$(this).is(':checked')) {
                            checked = false;
                        }
                    });
                    $('.baseCheckbox').each(function() {
                        if ($(this).attr('model') == model) {
                            $(this).prop('checked', checked);
                        }
                    });
                });
            }
            window.onload = checkBase;
        });

        $('.baseCheckbox').click(function() {
            let model = $(this).attr('model');
            console.log(model);
            if ($(this).is(':checked')) {
                $('.baseCheck_' + model).prop('checked', true);
            } else {
                $('.baseCheck_' + model).prop('checked', false);
            }
        });

        let checked;
        $('.checkInput').click(function() {
            let model = $(this).attr('model');
            checked = true;
            $('.baseCheck_' + model).each(function() {
                if (!$(this).is(':checked')) {
                    checked = false;
                }
            });
            $('.baseCheckbox').each(function() {
                if ($(this).attr('model') == model) {
                    $(this).prop('checked', checked);
                }
            });
        });
</script>
@endpush