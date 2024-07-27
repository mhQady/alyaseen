@extends('dash.layout.app')
@section('title', trans('main.admins'))
@section('main_folder', __('main.market'))
@section('sub_folder', __('main.admins'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@lang('main.admins')</h5>
                    @include('dash.user.parts.index.actions')
                </div>

            </div>
            <div class="card-body px-0 pb-0">

                @include('dash.user.parts.index.search')

                <div class="table-responsive">

                    <table class="table table-flush" id="admins-list">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('main.name')</th>
                                <th>@lang('main.email')</th>
                                <th data-sortable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $admin)
                            <tr>
                                <td class="text-sm">{{ $users->firstItem() + $key }}</td>
                                <td>
                                    <div>
                                        <h6 class="mx-3 my-auto text-sm">{{ $admin->name }}</h6>
                                    </div>
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-sm">
                                    <div class="d-flex justify-content-end">
                                        @can('update_user')
                                        <a href="{{ route('dash.admins.edit', $admin->id) }}" class="mx-3"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="@lang('main.update.admin')">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        @endcan
                                        @can('delete_user')
                                        <a href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete_{{ $admin->id }}">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                        @include(
                                        'dash.components.delete-modal',
                                        [
                                        'action' => route(
                                        'dash.admins.destroy',
                                        $admin->id
                                        ),
                                        'id' => $admin->id,
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
                {{ $users->appends(['search' => request('search')])->links() }}
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
    new simpleDatatables.DataTable("#admins-list", {
            searchable: false,
            "paging": false
        });
</script>
@endpush