@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/product-page.css'])
@endsection

@section('page-title')
    Brand-{{ $product->product_title }}
@endsection

@section('content')
    <div class="product-banner">
        <div class="image-container">
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="not found" class="image"/>
        </div>
        <div class="details-container">
            <div>Title: <span>{{ $product->product_title }}</span></div>
            <div>Category: <span>{{ $product->category->category_name }}</span></div>
            <div>Description: <span class="description-span">{{ $product->product_description }}</span></div>
            <div>Price: <span class="price-container">{{ $product->product_price }}</span> </div>
        </div>
    </div>
@endsection
