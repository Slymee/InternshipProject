@extends('userend.layouts.index-template')

@section('page-title')
    Brand-Product Checkout
@endsection

@section('vite-resource')
    @vite(['resources/css/nav-bar.css'])
@endsection

@section('content')
    {{ $checkoutProduct }}
@endsection
