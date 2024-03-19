@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/cart-items.css'])
@endsection

@section('page-title')
    Brand - Cart Items
@endsection

@section('content')
    <section class="banner-container">
        <div class="checkout-container">
            <div class="item-container">
                @foreach($cartItems as $cartItem)
                    <div class="cart-item-banner">
                        <div class="cart-item-img"><img src="{{ asset('storage/'.$cartItem->product->image_path) }}" alt=""></div>
                        <div class="cart-item-info">
                            <a href=""><div class="">{{ $cartItem->product->product_title }}</div></a>
                            <div class="">Amount: {{ $cartItem->amount }}</div>
                            <div class="">Quantity: {{ $cartItem->quantity }}</div>
                        </div>
                        <div class="cart-item-util">
                            <form method="POST" action="{{ route('remove-from-cart') }}">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $cartItem->id }}">
                                <input type="submit" value="Remove">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="utility-container">dfghdfgfdg</div>
        </div>
    </section>
@endsection
