@extends('layouts.app')

@push('styles')

@endpush

@section('title')
Dashboard
@endsection

@section('contents')

<div class="row">
    <div class="col-md-4">
        <a href="" class="text-decoration-none">
            <div class="card border-0 mb-2 bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient">
                                <i class="bi bi-cpu-fill text-primary"></i>
                            </h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0 text-primary"><strong>{{ $devices }}</strong></h2>
                            <p class="my-1 text-primary">Active Devices</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="" class="text-decoration-none">
            <div class="card bg-light border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient"><i class="fas fa-users"></i></h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0 text-primary"><strong>{{ $users }}</strong></h2>
                            <p class="my-1 text-primary">Active Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="" class="text-decoration-none">
            <div class="card bg-light border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient"><i class="fas fa-file-invoice"></i></h1>
                        </div>
                        <div class="col-9">
                            <h2 class="m-0 text-primary"><strong>{{ $categories }}</strong></h2>
                            <p class="my-1 text-primary">Our Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@push('scripts')
@endpush
