@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css'])
@endsection

@section('page-title')
    Brand-{{ $product->product_title }}
@endsection

@section('yield')
