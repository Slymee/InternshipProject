<tr>
    <td>{{ $category->id }}</td>
    <td style="text-align: left">{{ str_repeat('-', $category->level) }} {{ $category->category_name }}</td>
    <td><button>Edit</button></td>
    <td><button>Delete</button></td>
</tr>



@if ($category->children->isNotEmpty())
    @foreach ($category->children as $child)
        @include('commonComponents.admin-category', ['category' => $child])
    @endforeach    
@endif


