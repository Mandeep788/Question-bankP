<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/loginn.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	@if($errors->any())
  @foreach($errors->all() as $error)
  <p style="color:red;">{{$error}}</p>
  @endforeach
@endif
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div>
			<img class="bulb_image" src="img/person-removebg-preview.png" >
		</div>
		<div class="login-content">
			<form method="post">
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
						<i class="fas fa-user"></i>
					</div>
                    <div class="div">
                        <h5>Name</h5>
                        <input type="text" id="name" class="input" name="name">
                    </div>
                </div>
           		<div class="input-div one">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
           		    <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" id="email" class="input" name="email">
           		    </div>
           		</div>
                <div class="input-div one">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" id="password" class="input" name="password">
                    </div>
                </div>
                <div class="input-div ">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
                    <div class="div">
                        <h5>confirm password</h5>
						<input type="password" id="password_confirmation" name="password_confirmation" class="input"/>

                    </div>
                </div>


            	{{-- <a href="#">Forgot Password?</a> --}}
            	<input type="submit" class="btnn" id="register" value="Register">
                <a href="{{url('/login')}}" class="login_btn">Already have an account? LogIn</a>
            </form>
			@if(Session::has('success'))
			<p style="color:green;">{{ Session::get('success')}}</p>
		@endif
        </div>
    </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/register.js') }}"></script>
</body>
</html>
