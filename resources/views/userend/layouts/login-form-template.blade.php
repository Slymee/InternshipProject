<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>@yield('page-title')</title>
    @vite('resources/css/user-login.css')
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error-message{
            color: red;
        }
    </style>
   </head>
<body>
  @yield('content')
</body>
</html>