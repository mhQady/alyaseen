<form method="GET" id="searchForm">
    <div class="row justify-content-end align-items-center" style="padding-left: 1.5rem; padding-right: 1.5rem">
        <div class="col-3">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input value="{{ old('search', request('search')) }}" name="search" type="search" class="form-control"
                    placeholder="@lang('main.search.category')">
            </div>
        </div>
    </div>
</form>