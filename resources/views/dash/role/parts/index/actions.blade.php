<div class="d-flex justify-content-between align-items-center gap-2">
    @can('create_role')
    <a href="{{ route('dash.roles.create') }}" class="btn  btn-primary btn-sm mb-0">+&nbsp;
        @lang('main.create.role')</a>
    @endcan
</div>