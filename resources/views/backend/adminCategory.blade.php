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
    <title>Dashboard - Category</title>
</head>
<body>
    <section>
        <div class="side-nav">
            @include('commonComponents.side-nav')
        </div>
        <div class="side-container">
            @include('commonComponents.bread-crumb')
            <div class="content-container">
                <div class="add-button-container">
                    <a href={{ route('add.category.form') }}><button>Add Category</button></a>
                </div>
                <div class="display-data-container">
                    <span>Categories</span>

                    <div class="table-container">
                        <table>
                            <tr>
                                <th>SN</th>
                                <th>Category Name</th>
                                <th colspan="3">Utilities</th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>Fruit</td>
                                <td><button>Sub-categories</button></td>
                                <td><button>Edit</button></td>
                                <td><button>Delete</button></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>