@extends('backend.layouts.dashboard-template')

@section('vite-resource')
@vite(['resources/css/admin-dashboard.css', 'resources/css/side-nav.css', 'resources/css/admin-dashboard-subcategory.css'])
@endsection

@section('page-title')
    Dashboard-Sub-category
@endsection

@section('bread-crumb')
    Dashboard/Category/Sub Category
@endsection

@section('content')
    <div class="category-name-container">
        Parent Category: <span>{{ $parentName['category_name'] }}</span>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th colspan="2">Utilities</th>
            </tr>

            <tr>
                <td>1</td>
                <td style="text-align: left">Laptop</td>
                <td><button>Edit</button></td>
                <td><button>Delete</button></td>
            </tr>
        </table>
    </div>
@endsection