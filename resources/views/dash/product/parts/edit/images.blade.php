<div class="card mt-4">
    <div class="card-body">
        <input type="file" name="image" multiple />
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
    let files = []

    @if(count($product->getMedia('images')->pluck('original_url')))
    @php
    $urls = array_map(
            function ($url) {
                return parse_url($url)['path'];
            },
            $product->getMedia('images')->pluck('original_url')->toArray()
        );
    @endphp
        let urls = JSON.parse('{!!json_encode($urls)!!}')
        files = urls.map((url)=>{
            return { source : url,
                    options: {
                        type: 'local',
                    },
                }
        })
    @endif

FilePond.registerPlugin(FilePondPluginImagePreview,FilePondPluginImageValidateSize,FilePondPluginFileValidateType,FilePondPluginFileValidateSize,FilePondPluginImageTransform)
FilePond.create(document.querySelector('input[type="file"]'),{
allowMultiple: true,
allowReorder: true,
allowDuplicate: false,
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
storeAsFile: false,
server: {
    url:'{{ url('/') }}',
    load:'/',
    remove:async (source, load, error)=>{
    await fetch('{{ route("admin.products.delete.image", $product) }}',{
    method: 'DELETE',
    headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    body: JSON.stringify({
        source
    })
    })
    .then((response) => {
        Swal.mixin({
                toast: true,
                position: "{{ app()->getLocale()=='ar'?'top-start':'top-end' }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            }).fire({
            icon: 'success',
            title: "@lang('main.image_deleted')"
            })

            load()
        })
    },
    process: {
        url: '{!! "/admin/products/".$product->id."/upload-image" !!}',
        method: "POST",
        withCredentials: true,
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
        },
        timeout: 7000,
    },
},
onprocessfile: (file) => {
    Swal.mixin({
            toast: true,
            position: "{{ app()->getLocale()=='ar'?'top-start':'top-end' }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         }).fire({
        icon: 'success',
        title: "@lang('main.image_uploaded')"
        })
    },
files: files
})
</script>
@endpush
