<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('image/user/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/user/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/user/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/user/animate/animate.css') }} ">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/user/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/user/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/user/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/user/main.css') }}">
<!--===============================================================================================-->
<style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('image/user/img-01.png' ) }} " alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{ route ( 'user.register')}}" method="POST" id="regForm">
				@csrf
					<span class="login100-form-title">
						User Registration
					</span>

					

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-user-circle" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" >
						<textarea class="input100" type="text" name="address" placeholder="address"></textarea>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input" >
						<input class="input100" type="texta" name="phone" placeholder="phone">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						  <i class="fa fa-mobile" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

                  @if(Session::has('message-success'))
					<div class="alert alert-success mt-5" role="alert">
					   {{Session::get('message-success')}}
					</div>
				  @endif	

				  @if(Session::has('message-error'))
					<div class="alert alert-danger mt-5" role="alert">
					   {{Session::get('message-error')}}
					</div>
				  @endif	
				  
					<div class="text-center p-t-136">
						<a class="txt2" href="{{ route('user.login')}}">
							Already have an Account? Login Here✔
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset('vendor/user/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/user/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/user/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/user/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/user/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('js/user/main.js')}}"></script>
<!--=============================== JQuery Validation ===================================================-->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength:  10,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                        maxlength: 50,
                        minlength: 5,
						
                    }
                },
                messages: {
                    name: {
                        required: "Name is required",
                        maxlength: "Name cannot be more than 10 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                    },
                    phone: {
                        required: "Phone number is required",
                        minlength: "Phone number must be of 10 digits"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 3 characters",
                        maxlength: "Password must be at most 10 characters",
                    },
                    address: {
                        required: "Address is required",
                        maxlength: "Address cannot not be more than 50 characters",
                        minlength: "Address must be 3 characters long"
                    }
                }
            });
        });
    </script>

</body>
</html>