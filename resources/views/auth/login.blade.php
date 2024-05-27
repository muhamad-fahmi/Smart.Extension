<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Sign In - Smart.Extension</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('cork/src/assets/img/logo-smart-extension.png') }}"/>
    <link href="{{ asset('cork/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('cork/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('cork/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('cork/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/src/assets/css/light/authentication/auth-boxed.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('cork/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet" type="text/css" />
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>Sign In</h2>
                                    <p>Enter your email and password to login</p>

                                </div>
                                <form action="{{ route('login.post') }}" method="post">

                                    @csrf

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" placeholder="Enter Your Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input name="password" type="password" class="form-control" placeholder="Enter Your Password">
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
										<div class="alert alert-success alert-dismissible fade show border-0 mb-4">
											{{ session('success') }}
											 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
										</div>
								    @endif
								    @if (session('error'))
										<div class="alert alert-danger alert-dismissible fade show border-0 mb-4">
											{{ session('error') }}
											 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
										</div>
								    @endif

                                    {{-- {!! htmlFormSnippet() !!} --}}

                                    <div class="col-12 mt-4">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary w-100">SIGN IN</button>
                                        </div>
                                    </div>

                                </form>


                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Dont't have an account ? <a href="{{ route('register') }}" class="text-warning">Sign Up</a></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('cork/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
