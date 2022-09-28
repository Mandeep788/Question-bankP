<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginn.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @php
        if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass'])) {
            $login_email = Cookie::get('login_email');
            $login_pass = Cookie::get('login_pass');
            $is_remember = "checked='checked'";
        } else {
            $login_email = '';
            $login_pass = '';
            $is_remember = '';
        }

    @endphp

    <img class="wave" src="img/wave.png">
    <div class="container">
        <div>
            <img class="bulb_image" src="img/person-removebg-preview.png">
        </div>
        <div class="login-content">
            <form action="{{ route('userlogin') }}" method="post">
                @csrf
                <div>
                    <img src="img/ccc.jpeg" alt="" height="30px">
                </div>
                <div>
                    <img id="profile_icons" src="img/user.jpg">
                </div>
                <h2 class="title">Welcome</h2>
                <span id="invalid"></span>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-at"></i>
                    </div>
                    <div class="div">
                        <input type="text" name="email" id="email" placeholder="Email" class="input" value="{{ $login_email }}">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" name="password" id="password" placeholder="password" class="input"
                            value="{{ $login_pass }}">
                    </div>
                </div>
                <div class="col-5 mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberme" {{ $is_remember }}>
                        <label class="form-check-label" for="rememberme">
                            Remember me
                        </label>
                    </div>
                </div>
                {{-- <a href="#">Forgot Password?</a> --}}
                <input type="submit" class="btnn" id="login" value="Login">
                <a class="signup_btn" href="{{ url('/register') }}">Don't have an account? SignUp</a>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
</body>

</html>
