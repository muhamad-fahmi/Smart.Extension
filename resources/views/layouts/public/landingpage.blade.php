<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Smart.Extension - By Muhamad Fahmi 202043501341</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link href="{{ asset('assets/landingpage/css/styles.css') }}" rel="stylesheet" />

        @stack('styles')
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="/"><span class="fw-bolder text-primary">Smart.Extension</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item me-2"><a class="nav-link" href="/">Home</a></li>
                            <li class="nav-item me-2"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item me-2"><a class="nav-link" href="#features">Features</a></li>
                            <li class="nav-item me-2"><a class="nav-link" href="#contact_us">Contact Us</a></li>
                        </ul>
                        <div class="btn-group ms-3">
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-start">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary bg-grey">Register</a>
                        </div>
                    </div>
                </div>
            </nav>


            @yield('contents')


        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; <a class="text-decoration-none" href="">Smart.Extension</a> {{ date('Y') }}</div></div>
                    <div class="col-auto">
                        <p class="m-0 small">Developed By <a class="text-decoration-none" href="https://muhamad-fahmi.github.io" target="_blank">Muhamad Fahmi</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>

        @stack('scripts')
    </body>
</html>
