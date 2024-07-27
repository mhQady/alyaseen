@extends('dash.layout.app')
@section('title', trans('main.roles'))
@section('main_folder', __('main.market'))
@section('sub_folder', __('main.roles'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@lang('main.roles')</h5>
                    @include('dash.role.parts.index.actions')
                </div>

            </div>
            <div class="card-body px-0 pb-0">

                @include('dash.role.parts.index.search')

                <div class="table-responsive">

                    <table class="table table-flush" id="roles-list">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('main.name')</th>
                                <th data-sortable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $key => $role)
                            <tr>
                                <td class="text-sm">{{ $roles->firstItem() + $key }}</td>
                                <td>
                                    <div class="d-flex">
                                        <h6 class="mx-3 my-auto text-sm">{{ $role->name }}</h6>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    <div class="d-flex justify-content-end">
                                        @can('update_role')
                                        <a href="{{ route('dash.roles.edit', $role->id) }}" class="mx-3"
                                            data-bs-toggle="tooltip" data-bs-original-title="@lang('main.update.role')">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        @endcan
                                        @can('delete_role')
                                        <a href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete_{{ $role->id }}">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                        @include(
                                        'dash.components.delete-modal',
                                        [
                                        'action' => route(
                                        'dash.roles.destroy',
                                        $role->id
                                        ),
                                        'id' => $role->id,
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
                {{ $roles->appends(['search' => request('search')])->links() }}
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
    new simpleDatatables.DataTable("#roles-list", {
            searchable: false,
            "paging": false
        });
</script>
@endpush