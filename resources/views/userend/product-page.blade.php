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
        <div class="comment-section-title">Feedback/Queries</div>
        <div class="comment">
            <div class="comment-author">User1</div>
            <div class="comment-content">This is the main comment.</div>
            @if(auth()->id() == $product->user_id)
                <div class="utilities"><span>Reply</span></div>
            @endif
            <div class="reply">
                <div class="comment-author">User2</div>
                <div class="comment-content">Replying to User1's comment.</div>
{{--                <div class="utilities"><span>Reply</span></div>--}}
                <!-- Nested reply -->
{{--                <div class="reply">--}}
{{--                    <div class="comment-author">User1</div>--}}
{{--                    <div class="comment-content">Replying to User2's reply.</div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="comment-form">
        <h2>Add a Comment</h2>
        <form id="commentForm">

            <label for="comment">Your Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>

            <button type="submit">Post Comment</button>
        </form>
    </div>
@endsection
