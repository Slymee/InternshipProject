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
                <div class="cart-item-banner">
                    <div class="cart-item-img"></div>
                    <div class="cart-item-info"></div>
                </div>
            </div>
            <div class="utility-container">dfghdfgfdg</div>
        </div>
    </section>
@endsection
