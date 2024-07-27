@foreach ($subcategories as $child)
    <option value="{{ $child->id }}" @selected($child->id ==
        $product->subcategory_id)>{{ $child->name }}</option>
    @if ($child->children)
        @include('dashboard.products.parts.subcategories', [
            'subcategories' => $child->children,
        ]);
    @endif
@endforeach
