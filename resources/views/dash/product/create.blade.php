@extends('dash.layout.app')
@section('title', trans('main.create.product'))
@section('main_folder', __('main.products'))
@section('sub_folder', __('main.create.product'))
@section('content')
<form action="{{ route('dash.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-0 mt-lg-0 mt-2" id="submit-all">@lang('main.save')</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8">

            @include('dash.product.parts.create.main_info')

            {{-- @include('dash.product.parts.create.images') --}}

        </div>

        <div class="col-lg-4 mt-lg-0 mt-4">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('dash.product.parts.create.categories')
                        </div>
                    </div>
                </div>
            </div>


            @include('dash.product.parts.create.price')

        </div>
    </div>
</form>
@endsection
@push('script')
<script src="{{ asset('dashboard/js/plugins/choices.min.js') }}"></script>
@endpush