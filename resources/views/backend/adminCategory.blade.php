@extends('backend.layouts.dashboard-template')

@section('vite-resource')
@vite(['resources/css/admin-dashboard.css', 'resources/css/side-nav.css', 'resources/css/admin-dashboard-category.css'])
@endsection

@section('page-title')
    Dashboard-Category
@endsection

@section('bread-crumb')
    Dashboard/Category
@endsection

@section('content')
    <div class="add-button-container">
        <a href={{ route('add.category.form') }}><button>Add Category</button></a>
    </div>
    <div class="display-data-container">
        <span>Categories</span>


        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th colspan="3">Utilities</th>
                </tr>

                @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->category_name }}</td>
                    <td><button>Sub-categories</button></td>
                    <td><a href={{ route('admin.edit.category.form', $data->id) }}><button>Edit</button></a></td>
                    <td><button onclick="confirmDelete({{ $data->id }})">Delete</button></td>
                </tr>
                @endforeach

            </table>
        </div>


    </div>

    <script>
        function confirmDelete(categoryID){
            var result = window.confirm('Are you sure you want to delete this category');

            if(result){
                window.location.href = '/admin-delete-category/'+ categoryID;
            }
        }
    </script>
@endsection