<div class="card mt-3">
    <div class="card-body">
        <input type="file" name="images[]" multiple />
    </div>
</div>
@push('style')
<link rel="stylesheet" href="{{ asset('dashboard/js/plugins/filepond/filepond.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/js/plugins/filepond/filepond-plugin-image-preview.css') }}">
<style>
    .filepond--item {
        width: calc(20% - 0.5em) !important;
    }
</style>
@endpush

@push('script')
<script src="{{ asset('dashboard/js/plugins/filepond/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/filepond/filepond-plugin-image-validate-size.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/filepond/filepond-plugin-file-validate-type.js') }}"></script>
<script src="{{ asset('dashboard/js/plugins/filepond/filepond-plugin-image-transform.js') }}"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size"></script>
<script src="{{ asset('dashboard/js/plugins/filepond/filepond.js') }}"></script>

<script>
    FilePond.registerPlugin(FilePondPluginImagePreview,FilePondPluginImageValidateSize,FilePondPluginFileValidateType,FilePondPluginFileValidateSize,FilePondPluginImageTransform)
    FilePond.create(document.querySelector('input[type="file"]'),{
        allowMultiple: true,
        allowReorder: true,
        maxFiles: 15,
        checkValidity: true,
        maxFileSize: '2MB',
        labelMaxFileSize: '@lang("main.max_image_size",["size"=>"2MB"])',
        credits: false,
        dropOnPage: true,
        dropValidation: true,
        labelIdle:`<img style="height: 65px;" src='{{ asset('dashboard/images/defaults/product.svg') }}'>
            <span>@lang('main.drag_click_image')</span>`,
        acceptedFileTypes:['image/*'],
        storeAsFile: true,
    })
</script>
@endpush
