@extends('dash.layout.app')
@section('title', $product->name)
@section('main_folder', __('main.products'))
@section('sub_folder', $product->name)
@section('content')
<form action="{{ route('dash.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PATCH')
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-0 mt-lg-0 mt-2" id="submit-all">@lang('main.save')</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8">

            @include('dash.product.parts.edit.main_info')

            {{-- @include('dash.product.parts.edit.images') --}}

        </div>
        <div class="col-lg-4 mt-lg-0 mt-4">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('dash.product.parts.edit.categories')
                        </div>
                    </div>
                </div>
            </div>
            @include('dash.product.parts.edit.price')
        </div>
    </div>
</form>
@endsection
@push('script')
<script src="{{ asset('dashboard/js/plugins/choices.min.js') }}"></script>
@endpush