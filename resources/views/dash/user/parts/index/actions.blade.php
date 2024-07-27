<div class="d-flex justify-content-between align-items-center gap-2">
    @can('create_category')
    <a href="{{ route('dash.admins.create') }}" class="btn  btn-primary btn-sm mb-0">+&nbsp;
        @lang('main.create.admin')</a>
    @endcan
</div>