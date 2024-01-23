@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/create-product.css'])
@endsection

@section('page-title')
    Brand - Create an Ad
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <section>
        <div class="form-container">
            <span>Create an Ad</span>
            <form action="{{ route('product-ad-post') }}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="mb-3">
                  <label for="product_title" class="form-label">Product Title</label>
                  <input type="text" class="form-control" name="product_title" id="exampleFormControlInput1" placeholder="Enter Product Title">
                </div>
                <div class="mb-3">
                  <label for="product_description" class="form-label">Product Description</label>
                  <textarea class="form-control" name="product_description" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Product Description"></textarea>
                </div>
                <div class="mb-3">
                  <label for="product_price" class="form-label">Product Price</label>
                  <input type="number" class="form-control" name="product_price" id="exampleFormControlInput1" placeholder="Enter Product Price">
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload Product Image (Max: 2MB)</label>
                  <input class="form-control" type="file" id="formFile" name="product_image">
                </div>
                <div class="mb-3">
                  <label for="parentCategory" class="form-label">Select Category</label>
                  <select class="form-select" aria-label="Default select example" name="parent_category" id="parentCategory" onchange="fetchSubCategory()">
                    <option value="" selected>Select Category</option>
                    @foreach ($mainParent as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="subCategory" class="form-label">Select Sub Category</label>
                  <select class="form-select" aria-label="Default select example" name="sub_category" id="subCategory" onchange="fetchSubSubCategory()">
                    <option value="" selected>Select Sub Category</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="sub_sub_category" class="form-label">Select Sub Sub Category</label>
                  <select class="form-select" aria-label="Default select example" name="sub_sub_category" id="subSubCategory">
                    <option value="" selected>Select Sub Sub Category</option>
                  </select>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input class="btn btn-primary" type="submit" value="Create Ad">
                  <span class="error-message">
                    @if(session('message'))
                        {{ session('message') }}
                    @endif
    
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach                    
                    @endif
                    </span>
            </form>
        </div>
    </section>
    <script>
      /**
 * Level 2 Category
 */

async function fetchSubCategory(){
    document.querySelector('#subCategory').innerHTML = '<option selected>Select Sub Category</option>';
    // document.querySelector('#subCategory').innerHTML = '';

    var parentID = document.querySelector('#parentCategory').value;
    const URL = 'get-child-option/'+parentID;
    let response = await axios.get(URL);
    if(response.status===200){
      paginatedData = response.data;
      console.log(paginatedData);
      paginatedData.data.forEach(function (category) {
        $('#subCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
      });
    }
    // request.open("GET", "get-child-option/"+parentID, true);
    // request.send();
    // request.onreadystatechange = function(){
    //   if(request.readyState == 4 && request.status == 200){
    //     var data = JSON.parse(request.responseText);
    //     console.log(data);
    //     console.log(data[1]['data'][0]['category_name'])
    //     data.forEach(function (category) {
    //       $('#subCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
    //     });
    //   }
    // }
  }


/**
 * Level 3 Category
 */

  async function fetchSubSubCategory(){
    document.querySelector('#subSubCategory').innerHTML = '<option selected>Select Sub Sub Category</option>';
    // document.querySelector('#subCategory').innerHTML = '';

    var parentID = document.querySelector('#subCategory').value;
    const URL = 'get-child-option/'+parentID;
    let response = await axios.get(URL);
    if(response.status===200){
      paginatedData = response.data;
      console.log(paginatedData);
      paginatedData.data.forEach(function (category) {
        $('#subSubCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
      });
    }
  }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection