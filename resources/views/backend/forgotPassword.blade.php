<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>Forgot Password</title>
    @vite(['resources/css/admin-login.css'])
</head>
<body>
    <section class="main-section">
        <div class="form-banner">
            <div class="img-place">
                <img class="image" src="{{ URL('images/authenticate.jpg') }}" alt="Authenticate" srcset="">
            </div>
            <div class="form-place">
                <span class="login-dashboard-text">Forgot Password</span>
                <form action="/forgot-password" method="POST" autocomplete="off">
                    @csrf
                    <label for="email">Email</label><br>
                    <input type="text" name="email" id="" placeholder="Enter Email">
                    <br>
                    <input type="submit" value="Send Reset Link">
                </form>
                <span class="error-message">
                @if(session('error'))
                    {{ session('error') }}
                @endif

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        {{ $error}} <br>
                    @endforeach                    
                @endif
                </span>

            </div>
        </div>
    </section>

</body>
</html>