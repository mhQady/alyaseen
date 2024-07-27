<form method="GET" id="searchForm">
    <div class="row justify-content-end align-items-center" style="padding-left: 1.5rem; padding-right: 1.5rem">
        <div class="col-3">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input value="{{ old('search', request('search')) }}" name="search" type="search" class="form-control"
                    placeholder="@lang('main.search.product')">
            </div>
        </div>
        <div class="col-3">
            <select class="form-control btn-outline-primary" name="status" id="choices-status">
                <option value="">@lang('main.select')</option>
                @foreach (\App\Enums\Product\StatusEnum::cases() as $case)
                <option @selected(old('status',request('status'))==$case->value)
                    value="{{ $case->value }}">{{ __('main.'.strtolower($case->name)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

@push('script')
<script>
    let statusElement = document.getElementById('choices-status');

   new Choices(statusElement,{
      removeItemButton: true,
      searchEnabled: false,
      shouldSort: false,
   });



   statusElement.addEventListener('change', function() {
      document.getElementById(`searchForm`).submit()
   })
</script>
@endpush