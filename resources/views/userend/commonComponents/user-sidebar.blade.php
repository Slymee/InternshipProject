<div class="side-bar">
    <span class="sidebar-heading">Categories</span>
    <div class="category-container">
        @foreach($mainCategory as $category)
            <div class="parent-category-container">
                <span>{{ $category->category_name }}</span>
                @foreach($category->children as $child)
                    <div class="sub-category-container">
                        <span>{{ $child->category_name }}</span>
                        @foreach($child->children as $grandchild)
                            <div class="grandchild-anchor">
                                <a href="{{ route('product-listing', ['categoryId' => $grandchild->id]) }}">
                                    <div class="sub-sub-category-container">
                                        <span>{{ $grandchild->category_name }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
