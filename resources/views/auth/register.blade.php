<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/styles.css') }}">

    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->

</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100 align-items-center">
				<div class="card-wrapper">
					<h2 class="text-gradient text-center fw-bolder mb-4">Smart.Extension</h2>

					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form action="{{ route('register.post') }}" method="POST" class="my-login-validation" novalidate="">
								@csrf
								<div class="form-group mb-3">
									<label for="name" class="mb-2">Name</label>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group mb-3">
									<label for="email" class="mb-2">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>


                                <div class="form-group mb-3">
									<label for="whatsapp" class="mb-2">Whatsapp</label>
									<input id="whatsapp" type="number" class="form-control" name="whatsapp" required>
									<div class="invalid-feedback">
										Your whatsapp is invalid
									</div>
								</div>

								<div class="form-group mb-3">
									<label for="password" class="mb-2">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>



								<div class="d-flex justify-content-center m-0 mt-4">
									<button type="submit" class="btn btn-primary w-75">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; {{date('Y')}} &mdash; Developed By <a href="https://muhamad-fahmi.github.io" class="text-primary text-decoration-none" target="_blank">Muhamad Fahmi</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{asset('loginstyle/my-login.js')}}"></script>
</body>
</html>
