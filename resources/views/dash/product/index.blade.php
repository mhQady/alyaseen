@extends('dash.layout.app')
@section('title', trans('main.products'))
@section('main_folder', __('main.market'))
@section('sub_folder', __('main.products'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@lang('main.products')</h5>
                    @include('dash.product.parts.index.actions')
                </div>

            </div>
            <div class="card-body px-0 pb-0">

                @include('dash.product.parts.index.search')

                <div class="table-responsive">

                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('main.product')</th>
                                <th>@lang('main.sku')</th>
                                <th>@lang('main.price')</th>
                                <th>@lang('main.stock')</th>
                                <th>@lang('main.status')</th>
                                <th data-sortable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                            <tr>
                                <td class="text-sm">{{ $products->firstItem() + $key }}</td>
                                <td>
                                    <div class="d-flex">
                                        <h6 class="mx-3 my-auto text-sm">{{ $product->name }}</h6>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    {{ $product->sku }}
                                </td>
                                <td class="text-sm">
                                    {{ $product->price}}
                                </td>
                                <td class="text-sm">
                                    {{ $product->current_stock}}
                                </td>
                                <td class="text-xs">
                                    {!! $product->status->badge() !!}
                                </td>
                                <td class="text-sm">
                                    <div class="d-flex justify-content-end">
                                        @can('audit_product')
                                        <a href="{{ route('dash.products.activities', $product->id) }}" class="mx-1"
                                            data-bs-toggle="tooltip" data-bs-original-title="@lang('main.activity')">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                        @endcan
                                        @can('update_product')
                                        <a href="{{ route('dash.products.edit', $product->id) }}" class="mx-1"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="@lang('main.update.product')">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete_product')
                                        <a href="javascript:;" data-bs-toggle="modal" class="mx-1"
                                            data-bs-target="#modal-delete_{{ $product->id }}">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                        @include(
                                        'dash.components.delete-modal',
                                        [
                                        'action' => route(
                                        'dash.products.destroy',
                                        $product->id
                                        ),
                                        'id' => $product->id,
                                        ]
                                        )
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $products->appends(['search' => request('search'),'status' =>
                request('status')])->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@push('style')
<meta name="csrf_token" content="{{csrf_token()}}">
@endpush
@push('script')
<script src="{{ asset('dashboard/js/plugins/datatables.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/sweetalert.min.js') }}"></script>
<script>
    new simpleDatatables.DataTable("#products-list", {
            searchable: false,
            "paging": false
        });
</script>
@endpush