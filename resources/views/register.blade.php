<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
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
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="post">
				@csrf
				<span id="invalid"></span>
				<img src="img/avatar.svg">
				<h4 class="title">Welcome</h4>
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
           		   		<i class="fas fa-user"></i>
           		    </div>
           		    <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="email" id="email" class="input" name="email">
           		    </div>
           		</div>
                <div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" id="password" class="input" name="password">
                    </div>
                </div>
                <div class="input-div ">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
                    <div class="div">
                        <h5>confirm password</h5>
						<input type="password" id="password_confirmation" name="password_confirmation" class="input"/>

                    </div>
                </div>
           		
            	
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" id="register" value="Register">
            </form>
			@if(Session::has('success'))
			<p style="color:green;">{{ Session::get('success')}}</p>
		@endif
        </div>
    </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/register.js') }}"></script>
</body>
</html>