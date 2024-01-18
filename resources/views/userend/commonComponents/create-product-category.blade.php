<option value="{{ $category->id }}">{{ $category->category_name }}</option>


@if ($category->children->isNotEmpty())
    @foreach ($category->children as $child)
        @include('userend.commonComponents.create-product-category', ['category' => $child])
    @endforeach    
@endif