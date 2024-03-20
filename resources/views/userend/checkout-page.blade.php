@extends('userend.layouts.index-template')

@section('page-title')
    Brand-Product Checkout
@endsection

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/cart-items.css'])
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <section class="banner-container">
        <div class="checkout-container">
            <div class="item-container">
                @if($checkoutProduct)
                    <div class="cart-item-banner">
                        <div class="cart-item-img"><img src="{{ asset('storage/'. $checkoutProduct->image_path) }}" alt=""></div>
                        <div class="cart-item-info">
                            <a href="{{ route('product-display', $checkoutProduct->id) }}"><div class="">{{ $checkoutProduct->product_title }}</div></a>
                            <div class="">Quantity: {{ $quantity }}</div>
                            <div class="">Price: {{ $checkoutProduct->product_price }}</div>
                            <div class="">Amount: Rs. {{ $totalAmount = $quantity * $checkoutProduct->product_price}}</div>
                        </div>
                        <div class="cart-item-util">

                        </div>
                    </div>
                @endif
            </div>
            <div class="utility-container">
                <div class="total-amount-container">
                    Total Amount: <span>Rs. {{ $totalAmount }}</span>
                </div>
                <div class="checkout-button">
                    <button>Place Order</button>
                </div>
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
            </div>
        </div>
    </section>
@endsection
