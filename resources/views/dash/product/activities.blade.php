@extends('dash.layout.app')
@section('title', __('main.activities_on', ['model' => $product->name]))
@section('main_folder', __('main.products'))
@section('sub_folder', __('main.activities_on', ['model' => $product->name]))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@lang('main.activities_on', ['model' => $product->name])</h5>
                </div>

            </div>
            <div class="card-body px-0 pb-0">

                <form method="GET" id="searchForm">
                    <div class="row justify-content-end align-items-center"
                        style="padding-left: 1.5rem; padding-right: 1.5rem">
                        <div class="col-3">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search"
                                        aria-hidden="true"></i></span>
                                <input value="{{ old('search', request('search')) }}" name="search" type="search"
                                    class="form-control" placeholder="@lang('main.search.activity')">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">

                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('main.causer')</th>
                                <th>@lang('main.name')</th>
                                <th>@lang('main.description')</th>
                                <th>@lang('main.activity')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $key => $activity)
                            <tr>
                                <td class="text-sm">{{ $activities->firstItem() + $key }}</td>
                                <td class="text-sm">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-sm">{{ $activity->causer?->name }}</h6>
                                        <p>{{ $activity->causer?->email }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <h6 class="mx-3 my-auto text-sm">{{ $activity->log_name }}</h6>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    {{ $activity->description }}
                                </td>
                                <td class="text-sm">
                                    <div class="d-flex flex-column gap-2">
                                        @if(isset($activity->properties['old']))
                                        @foreach($activity->properties['old'] as $key => $value)
                                        <span> @lang("main.{$key}"): <div class="badge badge-secondary">{{ $value }}
                                            </div>
                                            <div class="badge badge-success">
                                                {{ $activity->properties['attributes'][$key] }}
                                            </div>
                                        </span>
                                        @endforeach
                                        @endif
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
                {{ $activities->appends(['search' => request('search')])->links() }}
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