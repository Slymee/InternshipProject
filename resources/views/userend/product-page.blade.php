@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/product-page.css'])
@endsection

@section('page-title')
    Brand-{{ $product->product_title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="product-banner">
        <div class="image-container">
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="not found" class="image"/>
        </div>
        <div class="details-container">
            <div>Title: <span>{{ $product->product_title }}</span></div>
            <div>Category: <span>{{ $product->category->category_name }}</span></div>
            <div>Description: <span class="description-span">{{ $product->product_description }}</span></div>
            <div class="price-container">Price: <span>{{ $product->product_price }}</span> </div>
            <div class="button-container">
                <a href="#"><button>Purchase</button></a>
            </div>
        </div>
    </div>

    <div class="comments-container">
        <div class="comment-section-title">Comments</div>

{{--        @foreach ($product->comments as $comment)--}}
{{--            @include('userend.commonComponents.comment', ['comment' => $comment])--}}
{{--        @endforeach--}}

    </div>

    <div class="comment-form">
        <h2>Add Feedback/Queries</h2>
        <form id="commentForm" method="POST" action="{{ route('post-comment') }}" enctype="multipart/form-data">
            @csrf

            <label for="comment">Your Comment:</label>
            <textarea id="comment" name="comment" rows="4"></textarea>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="comment_image" accept="image/*"><br>

            <input type="hidden" value="{{ auth()->id() }}" name="user_id">
            <input type="hidden" value="{{ $product->id }}" name="product_id">

            <button type="submit">Post Comment</button>

            <br><span class="error-message">
                @if(session('message'))
                    {{ session('message') }}
                @endif

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <br> {{ $error }}
                    @endforeach
                @endif
            </span>
        </form>
    </div>



@endsection
