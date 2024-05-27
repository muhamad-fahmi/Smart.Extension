<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('cork/src/assets/img/logo-smart-extension.png') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link href="{{ asset('cork/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    @stack('styles')
    <title>@yield('title')  - Belanja Berhadiah</title>

    <style>
        :root {
            --font-default: 'EB Garamond', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --font-primary: 'EB Garamond', serif; /*'Playfair Display', serif;*/
        --font-secondary: 'Inter', sans-serif;
                }
                .post-entry-1 {
        margin-bottom: 30px;
        }

        .post-entry-1 img {
        margin-bottom: 30px;
        }

        .post-entry-1 h2 {
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 500;
        line-height: 1.2;
        font-weight: 500;
        }

        .post-entry-1 h2 a {
        color: var(--color-black);
        }

        .post-entry-1.lg h2 {
        font-size: 40px;
        line-height: 1;
        }

        .post-meta {
        font-size: 11px;
        letter-spacing: 0.07rem;
        text-transform: uppercase;
        font-weight: 600;
        font-family: var(--font-secondary);
        color: rgba(var(--color-black-rgb), 0.4);
        margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-light bg-white navbar-expand-lg fixed-top shadow">
        <div class="container-fluid py-2 px-lg-5 px-md-5 px-sm-2">
            <a class="navbar-brand me-5" href="/">
                <img src="{{ asset('cork/src/assets/img/logo-belanja-berhadiah-horizon.png') }}" alt="Logo Belanja Berhadiah">
            </a>

            <button class="navbar-toggler border-0 shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-light">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        @if (auth()->user())
                        Kembali
                        @else
                        Masuk/Daftar
                        @endif
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="nav-desktop w-100 d-flex justify-content-end">
                        @if (auth()->user())
                            @if (auth()->user()->role_id == 1)
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary py-2 px-3">Kembali Ke Dashboard</a>
                            @else
                                <a href="{{ route('customer.dashboard') }}" class="btn btn-primary py-2 px-3">Kembali Ke Dashboard</a>
                            @endif
                        @else
                        <div class="btn-group">
                            <a href="{{ route('syarat_ketentuan', 'masuk') }}" class="btn btn-primary">Masuk</a>
                            <a href="{{ route('syarat_ketentuan', 'daftar') }}" class="btn btn-outline-primary">Daftar</a>
                        </div>
                        @endif
                    </div>
                    <div class="nav-mobile">
                        @if (auth()->user())
                            @if (auth()->user()->role_id == 1)
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary py-2 px-3 d-flex justify-content-center">Kembali Ke Dashboard</a>
                            @else
                                <a href="{{ route('customer.dashboard') }}" class="btn btn-primary py-2 px-3 d-flex justify-content-center">Kembali Ke Dashboard</a>
                            @endif
                        @else
                            <div class="py-4">
                                <a href="{{ route('syarat_ketentuan', 'masuk') }}" class="btn btn-primary me-2 w-100 mb-2">Masuk</a>
                                <a href="{{ route('syarat_ketentuan', 'daftar') }}" class="btn btn-outline-primary me-2 w-100">Daftar</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->


    <div class="contents">
        <div class="container px-3 px-sm-3 px-lg-5 px-xl-5">
            <div class="row">
                 <div class="col-md-8">
                     <div class="card border-0 mb-4 shadow-none bg-transparent">
                         <div class="card-body">
                            @yield('contents')
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="position-sticky" style="top: 6rem;">
                         <div class="card border-0 mb-4 shadow-none">
                             <div class="card-body">
                                 <h5 class="mb-0 d-flex gap-3 title">
                                     <i class="fas fa-bullhorn"></i> <span>Berita Terbaru</span>
                                 </h5>
                                 <hr>
                                 <div class="py-3">


                                     <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">


                                        @if ($news->count() > 0)
                                            @foreach ($news as $news_undian)

                                                <div class="post-entry-1 border-bottom">
                                                    <div class="post-meta"><span class="date">{{ ucwords($news_undian->news_category->title) }}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($news_undian->created_at)->format('d/m/Y') }}</span></div>
                                                    <h2 class="mb-2"><a href="{{ route('news.show', ['category' => $news_undian->news_category_id, 'slug' => $news_undian->slug]) }}">{{ ucwords($news_undian->title) }}</a></h2>
                                                    @php
                                                       $blog_desc = strip_tags($news_undian->content);
                                                       $blog_desc_simplify = substr($blog_desc, 0, 100);
                                                    @endphp
                                                    <span class="mb-3 d-block lh-lg">{{ ucfirst($blog_desc_simplify) }} ...</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="m-0">Tidak ada data berita</p>
                                        @endif

                                    </div>
                                 </div>
                             </div>
                             <div class="card-footer d-flex justify-content-end border-0">
                                <a href="{{ route('news.index') }}" class="text-decoraion-none text-primary">Tampilkan Lainnya</a>
                             </div>
                         </div>
                         {{-- <div class="card border-0">
                             <div class="card-body">
                                 <h5 class="mb-0 d-flex gap-3 title">
                                     <i class="fab fa-youtube"></i> <span>Streaming Undian</span>
                                 </h5>
                                 <hr>
                                 <div class="py-3">
                                     <iframe class="w-100" height="315" src="https://www.youtube.com/embed/ZmK7tVhzYuM?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                 </div>
                             </div>
                         </div> --}}
                     </div>
                 </div>
            </div>
         </div>
    </div>

    <!-- FOOTER SECTION  -->
    <section class="footer">
        <footer class="footer bg-primary mt-5">
            <div class="container">
                <p class="text-center mb-0 mt-4">Copyright {{ date('Y') }} | Developed by <a href="https://muhamad-fahmi.github.io" target="_blank" class="text-decoration-none text-light">MF</a></p>
            </div>

        </footer>
    </section>
    <!-- END FOOTER SECTION -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    @stack('scripts')

</body>

</html>
