<div class="side-bar">
    <span class="sidebar-heading">Categories</span>
    <div class="category-container">
        @foreach($parentCategory as $category)
            <div class="parent-category-container">
                <span>{{ $category->category_name }}</span>
                @foreach($childCategories->where('parent_id', $category->id) as $children)
                    <div class="sub-category-container">
                        <span>{{ $children->category_name }}</span>
                        @foreach($grandchildCategories->where('parent_id', $children->id) as $grandchildren)
                            <div class="grandchild-anchor">
                                <a href="{{ route('product-listing', ['categoryId' => $grandchildren->id]) }}">
                                    <div class="sub-sub-category-container">
                                        <span>{{ $grandchildren->category_name }}</span>
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
