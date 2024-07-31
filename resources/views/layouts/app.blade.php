<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', '') - Smart.Extension App</title>

    <link rel="stylesheet" href="{{ asset('assets/landingpage/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/system/css/style.css') }}">

    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('styles')

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light d-flex flex-column shadow-sm" id="sidebar-wrapper">
      <div class="sidebar-heading text-primary d-flex align-items-center"><strong>Smart.Extension</strong> </div>
      <div class="list-group list-group-flush">

        @if (auth()->user()->role_id == 1)

            <a href="{{ route('admin.dashboard') }}" class="list-group-item py-3 list-group-item-action border-0 bg-light justify-content-start {{ Request::is('*/admin/dashboard') ? 'fw-bold' : '' }}">
                <i class="bi bi-speedometer2 text-primary me-3"></i>
                Dashboard
            </a>

             <a href="#submenu1" class="list-group-item py-3 list-group-item-action border-0 bg-light dropdown-toggle" data-toggle="collapse">
                <div class="justify-content-start">
                    <i class="bi bi-tags text-primary me-3"></i>
                    Categories
                </div>
            </a>
            <div class="collapse {{ Request::is('*/admin/device-category*') ? 'show' : '' }}" id="submenu1">
                <a href="{{ route('admin.device.category.create') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Create Category</a>
                <a href="{{ route('admin.device.category.manage') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Manage Categories</a>
            </div>

            <a href="#submenu2" class="list-group-item py-3 list-group-item-action border-0 bg-light dropdown-toggle" data-toggle="collapse">
                <div class="justify-content-start">
                    <i class="bi bi-sliders text-primary me-3"></i>
                    Sensors
                </div>
            </a>
            <div class="collapse {{ Request::is('*/admin/device-sensor*') ? 'show' : '' }}" id="submenu2">
                <a href="{{ route('admin.device.sensor.create') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Create Sensor</a>
                <a href="{{ route('admin.device.sensor.manage') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Manage Sensors</a>
            </div>


            <a href="#submenu3" class="list-group-item py-3 list-group-item-action border-0 bg-light dropdown-toggle" data-toggle="collapse">
                <div class="justify-content-start">
                    <i class="bi bi-cpu-fill text-primary me-3"></i>User Devices
                </div>
            </a>
            <div class="collapse {{ Request::is('*/admin/devices*') ? 'show' : '' }}" id="submenu3">
                <a href="{{ route('admin.device.create') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Generate Device</a>
                <a href="{{ route('admin.device.manage') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Manage Devices</a>
            </div>

            <a href="#submenu4" class="list-group-item py-3 list-group-item-action border-0 bg-light dropdown-toggle" data-toggle="collapse">
                <div class="justify-content-start">
                    <i class="bi bi-people-fill text-primary me-3"></i>
                    Users
                </div>
            </a>
            <div class="collapse {{ Request::is('*/admin/user*') ? 'show' : '' }}" id="submenu4">
                <a href="{{ route('admin.user.manage') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Manage Users</a>
            </div>

        @else
            <a href="{{ route('customer.dashboard') }}" class="list-group-item py-3 list-group-item-action border-0 bg-light justify-content-start {{ Request::is('*/customer/dashboard') ? 'fw-bold' : '' }}">
                <i class="bi bi-speedometer2 text-primary me-3"></i>
                Dashboard
            </a>

            <a href="#submenu1" class="list-group-item py-3 list-group-item-action border-0 bg-light dropdown-toggle" data-toggle="collapse">
                <div class="justify-content-start">
                    <i class="bi bi-cpu-fill text-primary me-3"></i>
                    My Devices
                </div>
            </a>
            <div class="collapse {{ Request::is('*/customer/my-device*') ? 'show' : '' }}" id="submenu1">
                <a href="{{ route('customer.device.create') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Register Device</a>
                <a href="{{ route('customer.device.manage') }}" class="list-group-item border-0 list-group-member py-3 list-group-item-action bg-light pl-4">Manage Devices</a>
            </div>
        @endif
      </div>
      <div class="sidebar-footer mt-auto text-primary text-center small">V.1.0.0</div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-primary border-bottom">
        <button class="btn btn-light" id="menu-toggle">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </button>

        <button class="navbar-toggler me-2 border-light shadow-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-white" style="font-size: 29px"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 p-3 p-md-0 p-lg-0 p-xl-0">

            <li class="nav-item dropleft user-profile">
              <a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/landingpage/img/user/useravatar.png')}}" alt="avatar" class="avatar"> <span class="ms-2 text-light">{{ auth()->user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right mt-3  shadow-sm" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/admin/profile">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid mb-5">
        <div class="container mt-5">
            <div class="container mb-4">
                <h2 class="text-primary display-6 fw-bold mb-4">@yield('page')</h2>

                @if (!empty($breadcrumbs))
                <div class="card card-body shadow-sm border-0">
                    <nav class="c-navigation-breadcrumbs" aria-label="Breadcrumb" vocab="https://schema.org/" typeof="BreadcrumbList">
                        <ol class="c-navigation-breadcrumbs__directory">
                            @foreach ($breadcrumbs as $index => $breadcrumb)
                                <li class="c-navigation-breadcrumbs__item" property="itemListElement" typeof="ListItem">
                                    @if ($breadcrumb['url'])
                                        <a class="c-navigation-breadcrumbs__link text-decoration-none d-flex align-items-center" href="{{ $breadcrumb['url'] }}" property="item" typeof="WebPage">
                                            @if ($index == 0)
                                                <i class="bi bi-house-door-fill"></i>
                                                <span class="u-visually-hidden" property="name">{{ $breadcrumb['name'] }}</span>
                                            @else
                                                <span property="name">{{ $breadcrumb['name'] }}</span>
                                            @endif
                                        </a>
                                    @else
                                        <a class="c-navigation-breadcrumbs__link text-decoration-none" property="name" aria-current="location">{{ $breadcrumb['name'] }}</a>
                                    @endif
                                    <meta property="position" content="{{ $index + 1 }}">
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div><br>

                @endif
                {{-- <div class="card card-body shadow-sm border-0 mb-4">
                    <nav class="c-navigation-breadcrumbs" aria-label="Breadcrumb" vocab="https://schema.org/" typeof="BreadcrumbList">
                        <ol class="c-navigation-breadcrumbs__directory">

                            <li class="c-navigation-breadcrumbs__item" property="itemListElement" typeof="ListItem">
                                <a class="c-navigation-breadcrumbs__link text-decoration-none d-flex align-items-center" href="/" property="item" typeof="WebPage">
                                    <i class="bi bi-house-door-fill"></i>
                                    <span class="u-visually-hidden" property="name">Home</span>
                                </a>
                                <meta property="position" content="1">
                            </li>

                            <li class="c-navigation-breadcrumbs__item" property="itemListElement" typeof="ListItem">
                                <a class="c-navigation-breadcrumbs__link text-decoration-none" href="https://example.com/articles/" property="item" typeof="WebPage">
                                    <span property="name">Articles</span>
                                </a>
                                <meta property="position" content="2">
                            </li>

                            <li class="c-navigation-breadcrumbs__item" property="itemListElement" typeof="ListItem">
                                <a class="c-navigation-breadcrumbs__link text-decoration-none" href="https://example.com/articles/development" property="item" typeof="WebPage">
                                    <span property="name">Development</span>
                                </a>
                                <meta property="position" content="3">
                            </li>

                            <li class="c-navigation-breadcrumbs__item" property="itemListElement" typeof="ListItem">
                                <a class="c-navigation-breadcrumbs__link text-decoration-none" property="name" aria-current="location">Shared Vocabulary</a>
                                <meta property="item" typeof="WebPage" content="https://example.com/articles/development/shared-vocabulary">
                                <meta property="position" content="4">
                            </li>

                        </ol>
                    </nav>
                </div> --}}

            </div>




            @yield('contents')
        </div><br>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/system/js/script.js') }}"></script>

    @routes

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        if ($('#wrapper').hasClass('toggled')) {
            $('#menu-toggle').empty();
            $('#menu-toggle').append('<i class="fa fa-chevron-right" aria-hidden="true"></i>');
        } else {
            $('#menu-toggle').empty();
            $('#menu-toggle').append('<i class="fa fa-chevron-left" aria-hidden="true"></i>');
        }
    });

    $(document).ready(() => {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    })
    </script>

    {{-- custom script --}}
    @stack('scripts')

    @if(session('success'))
        <script>
            toastr["success"](`{{ session('success') }}`);
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr["error"](`{{ session('error') }}`);
        </script>
    @endif


</body>

</html>
