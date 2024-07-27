<div class="d-flex justify-content-between align-items-center gap-2">
    {{-- @can('create_product') --}}
    <a href="{{ route('dash.products.create') }}" class="btn  btn-primary btn-sm mb-0">+&nbsp;
        @lang('main.create.product')</a>
    {{-- @endcan --}}
</div>