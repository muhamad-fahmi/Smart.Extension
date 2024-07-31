<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="author" content="Kodinger">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Login - {{ env('APP_NAME') }}</title>
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
							<h4 class="card-title text-center">Login</h4>
							<form action="{{ route('login.post') }}" method="POST" class="my-login-validation" novalidate="">
								@csrf
								<div class="form-group mb-3">
									<label for="email" class="mb-2">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="mb-2">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>
								@if ($errors->any())
										<div class="alert alert-danger ">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
								@endif
								@if (session('success'))
										<div class="alert animate__animated alert-success alert-dismissible fade show">
											{{ session('success') }}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
								@endif
								@if (session('error'))
										<div class="alert animate__animated alert-danger alert-dismissible fade show">
											{{ session('error') }}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
								@endif
								<div class="d-flex justify-content-center m-0 mt-4">
									<button type="submit" class="btn btn-primary w-75">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="{{ route('register') }}" class="text-primary text-decoration-none">Create One</a>
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
</body>
</html>
