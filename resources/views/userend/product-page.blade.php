@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/product-page.css'])
@endsection

@section('page-title')
    Brand-{{ $product->product_title }}
@endsection

@section('content')
    <div class="product-banner">
        <div class="image-container">asjdkaskd</div>
        <div class="details-container">kasdjkas</div>
    </div>
@endsection
