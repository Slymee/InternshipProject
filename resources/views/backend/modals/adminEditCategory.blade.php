@extends('backend.layouts.dashboard-template')

@section('vite-resource')
@vite(['resources/css/admin-dashboard.css', 'resources/css/side-nav.css', 'resources/css/admin-dashboard-category.css'])
@endsection

@section('page-title')
    Dashboard-Edit Category
@endsection

@section('bread-crumb')
    Dashboard/Category/Edit
@endsection

@section('content')
<div class="form-container">
    <span>Edit Category</span>
    <form action={{ route('admin.edit.category') }} autocomplete="off" method="POST">
        @csrf
        <label for="category_name">New Category Name </label><br>
        <input type="text" name="category_name" placeholder="Enter New Category Name" value="{{ $editableData['category_name'] }}"><br>
        <input type="hidden" name="category_id" value="{{ $editableData['id'] }}">

        @if($editableData['parent_id']!=null)
        <select name="parent_id" id="">
            <option value="" selected>-- Select Parent Category --</option>
                @if($datas)
                    @foreach ($datas as $data)
                        <option value={{ $data->id }} {{ $data->id==$editableData['parent_id'] ? 'selected' : '' }}>{{ $data->category_name }}</option>
                    @endforeach
                @endif
        </select>
        @endif

        <input type="submit" name="" id="" value="Edit Category">
        
        @if (session('message'))
        <span class="message">{{ session('message') }}</span>
        @endif

    </form>
</div>

@endsection