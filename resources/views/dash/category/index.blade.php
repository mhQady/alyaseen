@extends('dash.layout.app')
@section('title', trans('main.categories'))
@section('main_folder', __('main.market'))
@section('sub_folder', __('main.categories'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@lang('main.categories')</h5>
                    @include('dash.category.parts.index.actions')
                </div>

            </div>
            <div class="card-body px-0 pb-0">

                @include('dash.category.parts.index.search')

                <div class="table-responsive">

                    <table class="table table-flush" id="categories-list">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('main.name')</th>
                                <th data-sortable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                            <tr>
                                <td class="text-sm">{{ $categories->firstItem() + $key }}</td>
                                <td>
                                    <div class="d-flex">
                                        <h6 class="mx-3 my-auto text-sm">{{ $category->name }}</h6>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    <div class="d-flex justify-content-end">
                                        @can('update_category')
                                        <a href="{{ route('dash.categories.edit', $category->id) }}" class="mx-3"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="@lang('main.update.category')">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        @endcan
                                        @can('delete_category')
                                        <a href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete_{{ $category->id }}">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                        @include(
                                        'dash.components.delete-modal',
                                        [
                                        'action' => route(
                                        'dash.categories.destroy',
                                        $category->id
                                        ),
                                        'id' => $category->id,
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
                {{ $categories->appends(['search' => request('search')])->links() }}
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
    new simpleDatatables.DataTable("#categories-list", {
            searchable: false,
            "paging": false
        });
</script>
@endpush