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
                <span class="login-dashboard-text">Reset Password</span>
                <form action="/forgot-password" method="POST" autocomplete="off">
                    @csrf
                    <label for="new-password">New Password</label><br>
                    <input type="password" name="new-password" id="" placeholder="Enter New Password">
                    <br>
                    <label for="confirm-password">Confirm Password</label><br>
                    <input type="password" name="confirm-password" id="" placeholder="Confirm New Password">
                    
                    <input type="submit" value="Confirm Password">
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