<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    @vite(['resources/css/admin-dashboard.css', 'resources/css/side-nav.css', 'resources/css/admin-dashboard-category.css'])
    <title>Dashboard - Add Category</title>
</head>
<body>
    <section>
        <div class="side-nav">
            @include('commonComponents.side-nav')
        </div>
        <div class="side-container">
            @include('commonComponents.bread-crumb')
            <div class="content-container">
                <div class="form-container">
                    <span>Add a Category</span>
                    <form action={{ route('admin.insert.category') }} autocomplete="off" method="POST">
                        @csrf
                        <label for="category_name">Category Name </label><br>
                        <input type="text" name="category_name" placeholder="Enter Category Name"><br>

                        <select name="parent_id" id="">
                            <option value="" selected>-- Select Parent Category --</option>
                                @if($datas)
                                    @foreach ($datas as $data)
                                        <option value={{ $data->id }}>{{ $data->category_name }}</option>
                                    @endforeach
                                @endif
                        </select>

                        <input type="submit" name="" id="" value="Create New Category">
                        
                        @if (session('message'))
                        <span class="message">Category Inserted</span>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>