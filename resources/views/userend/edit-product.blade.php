@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/create-product.css'])
@endsection

@section('page-title')
    Brand - Edit Product
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Include Select2 CSS and JS files -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <section>
        <div class="form-container">
            <span>Edit Product</span>
            <form action="{{ route('product-update', $productDetails->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="product_title" id="exampleFormControlInput1" placeholder="Enter Product Title" value="{{ $productDetails->product_title }}">
                </div>
                <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description</label>
                    <textarea class="form-control" name="product_description" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Product Description">{{ $productDetails->product_description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" name="product_price" id="exampleFormControlInput1" placeholder="Enter Product Price" value="{{ $productDetails->product_price }}">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Product Image (Max: 2MB)</label>
                    <input class="form-control" type="file" id="formFile" name="product_image">
                </div>
                <div class="mb-3">
                    <label for="parentCategory" class="form-label">Select Category</label>
                    <select class="form-select" aria-label="Default select example" name="parent_category" id="parentCategory" onchange="fetchSubCategory()">
                        <option value="{{ $productDetails->categories[0]->id }}" selected>{{ $productDetails->categories[0]['category_name'] }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subCategory" class="form-label">Select Sub Category</label>
                    <select class="form-select" aria-label="Default select example" name="sub_category" id="subCategory">
                        <option value="{{ $productDetails->categories[1]->id }}" selected>{{ $productDetails->categories[1]['category_name'] }}</option>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="sub_sub_category" class="form-label">Select Sub Sub Category</label>
                    <select class="form-select" aria-label="Default select example" name="sub_sub_category" id="subSubCategory" onchange="tagEnterDiv()">
                        <option value="{{ $productDetails->categories[2]->id }}" selected>{{ $productDetails->categories[2]['category_name'] }}</option>
                    </select>
                </div>
                <div class="mb-3" id="tagDiv">
                    <label for="tags">Enter Tags:</label>
                    <select name="product_tags[]" class="form-select form-select-lg mb-3" id="tags" multiple>
                        @foreach($productDetails->tags as $tag)
                            <option value="{{ $tag->tag_name }}" selected>{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input class="btn btn-primary" type="submit" value="Edit">
                <span class="error-message">
                    @if(session('message'))
                        <br>{{ session('message') }}
                    @endif

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <br> {{ $error }}
                        @endforeach
                    @endif
                </span>
            </form>
        </div>
    </section>
    @vite(['resources/js/product-edit.js'])
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' '],
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
