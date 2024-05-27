@extends('layouts.app')

@push('styles')
<link href="{{ asset('cork/src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


<link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

@endpush

@section('title')
    Dashboard
@endsection

@section('pagenow')
    Dashboard
@endsection

@section('contents')

<div class="row">
    <div class="col-md-4">
        <a href="">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-primary"><i class="fa-solid fa-house-laptop"></i></h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0"><strong>{{ $devices }}</strong></h2>
                            <p class="my-1">Active Devices</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-success"><i class="fas fa-users"></i></h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0"><strong>{{ $users }}</strong></h2>
                            <p class="my-1">Active Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-warning"><i class="fas fa-file-invoice"></i></h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0"><strong>{{ $categories }}</strong></h2>
                            <p class="my-1">Our Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

    {{-- <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-two">
            <div class="widget-heading">
                <h5 class="">Sales by Category</h5>
            </div>
            <div class="widget-content">
                <canvas id="productCategoryChart" class="w-100 h-100"></canvas>
            </div>
        </div>
    </div> --}}




@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('cork/src/plugins/src/table/datatable/datatables.js') }}"></script>

<script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
<script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

    <?php
            if(session('success')) {
                ?>
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('success') }}'
                    })
                <?php
            }
            if(session('error')) {
                ?>
                    Toast.fire({
                        icon: 'error',
                        title: '{{ session('error') }}'
                    })
                <?php
            }
        ?>
</script>
@endpush
