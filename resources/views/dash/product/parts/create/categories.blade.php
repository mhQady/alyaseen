<label>@lang('main.select')</label>@error('categories.*')
<span class="text text-danger mx-2">{{ $message }}</span>
@enderror
<select class="form-control" name="category_id" id="choices-category">
    @foreach ($categories as $category)
    <option @selected(old('category_id')==$category->id)
        value="{{ $category->id}}">{{ $category->name }}</option>
    @endforeach
</select>

@push('script')
<script>
    new Choices(document.getElementById('choices-category'), {
        removeItemButton: false,
        shouldSort: false,
    });
</script>
@endpush