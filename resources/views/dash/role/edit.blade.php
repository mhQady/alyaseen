@extends('dash.layout.app')
@section('title',$role->name)
@section('main_folder', __('main.categories'))
@section('sub_folder',$role->name)
@section('content')
<form action="{{ route('dash.roles.update', $role) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PATCH')
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-0 mt-lg-0 mt-2" id="submit-all">@lang('main.save')</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h5 class="font-weight-bolder mb-0">{{ $role->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label>@lang('main.name')</label>
                            <input class="form-control" name="name" type="text"
                                value="{{ old('name', $role->name) }}" />
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
                                                <input name="permissions[]" @checked(in_array($modelPermission->name,
                                                old('permissions', $role->permissions->pluck('name')->toArray())))
                                                model="{{ $permission->first()->model }}"
                                                class="baseCheck_{{ $permission->first()->model }} checkInput
                                                form-check-input ms-auto"
                                                type="checkbox" id="checkbox_{{ $modelPermission->id }}"
                                                value="{{ $modelPermission->name }}">
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                    for="checkbox_{{ $modelPermission->id }}">
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