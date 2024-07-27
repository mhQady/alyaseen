<div class="card">
    <div class="card-header d-flex justify-content-between pb-0">
        <h5 class="font-weight-bolder mb-0">{{ $product->name }}</h5>

        <div class="select-choices-min-width">
            <select class="form-control btn-outline-primary" name="status" id="choices-status">
                @foreach (\App\Enums\Product\StatusEnum::cases() as $case)
                <option @selected(old('status',$product->status)==$case->value)
                    value="{{ $case->value }}">{{ __('main.'.strtolower($case->name)) }}</option>
                @endforeach
            </select>
            @error('status')
            <div class=" text  text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <label>@lang('main.en.name')</label>
                <input class="form-control" name="name[en]" type="text"
                    value="{{ old('name.en', $product->getTranslation('name', 'en')) }}" />
                @error('name.en')
                <div class=" text  text-danger">{{ $message }}</div>
                @enderror
                @error('slug')
                <div class=" text  text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label>@lang('main.ar.name')</label>
                <input class="form-control" name="name[ar]" type="text"
                    value="{{ old('name.ar', $product->getTranslation('name', 'ar')) }}" />
                @error('name.ar')
                <div class=" text  text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6 col-md-12">
                <label>@lang('main.sku')</label>
                <input class="form-control" name="sku" type="text" value="{{ old('sku', $product->sku) }}" />
                @error('sku')
                <div class=" text  text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <ul class="nav nav-tabs p-0" id="descriptionTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <label class="nav-link ms-0 active" id="description-en-tab" data-bs-toggle="tab"
                            data-bs-target="#description-en" type="button" role="tab" aria-controls="description-en"
                            aria-selected="true">@lang('main.en.description')</label>
                    </li>
                    <li class="nav-item" role="presentation">
                        <label class="nav-link ms-0" id="description-ar-tab" data-bs-toggle="tab"
                            data-bs-target="#description-ar" type="button" role="tab" aria-controls="description-ar"
                            aria-selected="false">@lang('main.ar.description')</label>
                    </li>
                </ul>
                <div class="tab-content" id="descriptionTabContent">
                    <div class="tab-pane fade show active" id="description-en" role="tabpanel"
                        aria-labelledby="description-en-tab">
                        <textarea name="description[en]" placeholder="@lang('main.en.description')"
                            class="form-control input-with-tab text-editor">{{old('description.en',$product->getTranslation('description','en'))}}</textarea>
                        @error('description.en')
                        <div class=" text  text-danger">{{ $message }}</div>
                        @enderror
                        @error('description.ar')
                        <div class=" text  text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="tab-pane fade" id="description-ar" role="tabpanel" aria-labelledby="description-ar-tab">
                        <textarea name="description[ar]" placeholder="@lang('main.ar.description')"
                            class="form-control input-with-tab text-editor">{{old('description.ar',$product->getTranslation('description','ar'))}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{asset('dashboard/js/plugins/tinymce/tinymce.min.js')}}"></script>

<script>
    new Choices(document.getElementById('choices-status'),{
      searchEnabled: false,
      itemSelectText: "{{ __('main.press_to_select') }}",
      shouldSort: false,
   });

   // init text editor
   tinymce.init({
   selector: 'textarea.text-editor',
   branding: false,
   });
</script>
@endpush