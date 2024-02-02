@extends('userend.layouts.dashboard-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/my-products.css'])
@endsection

@section('page-title')
    Brand - Dashboard
@endsection

@section('content')
    <div class="main-container">
        <span class="">My Products</span>
        <div class="table-container">
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image Path</th>
                        <th>Image</th>
                        <th colspan="2">Configuration</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_title }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->image_path }}</td>
                                <td><img src="{{ asset('storage/'.$product->image_path) }}" alt="no image" style="height: 50px;width:100px;"></td>
                                <td><a href=""><button type="button" class="btn btn-dark">Edit</button></a> </td>
                                <td><a href=""><button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Delete</button></a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = '/product/' + productId + '/destroy';
            }
        }
    </script>
@endsection
