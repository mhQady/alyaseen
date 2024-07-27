@extends('dash.layout.app')
@section('title', __('main.create.admin'))
@section('main_folder', __('main.admins'))
@section('sub_folder', __('main.create.admin'))
@section('content')
<form action="{{ route('dash.admins.store') }}" method="POST" enctype="multipart/form-data">
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
                    <h5 class="font-weight-bolder mb-0">@lang('main.create.admin')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>@lang('main.name')</label>
                            <input value="{{ old('name') }}" name="name" class="form-control" type="text"
                                placeholder="{{ __('main.name') }}" />
                            @error('name')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>@lang('main.email')</label>
                            <input value="{{ old('email') }}" name="email" class="form-control" type="email"
                                placeholder="{{ __('main.email') }}" />
                            @error('email')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>@lang('main.password')</label>
                            <input value="{{ old('password') }}" name="password" class="form-control" type="password"
                                placeholder="{{ __('main.password') }}" />
                            @error('password')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="#choices-roles">@lang('main.roles')</label>
                            <select class="form-control" name="roles[]" id="choices-roles" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('script')
<script>
    if (document.getElementById("choices-roles")) {
            var tags = document.getElementById("choices-roles");
            const examples = new Choices(tags, {
                removeItemButton: true,
            });
        }
</script>
@endpush