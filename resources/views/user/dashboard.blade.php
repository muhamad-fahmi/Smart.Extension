@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
@endpush

@section('title')
    Dashboard
@endsection

@section('page')
    Dashboard
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('customer.device.manage') }}" class="text-decoration-none">
                    <div class="card bg-light border-0 mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <h1 class="m-0 text-gradient"><i class="fa-solid fa-house-laptop "></i></h1>
                                </div>
                                <div class="col-9">
                                    <h2 class="m-0 text-primary"><strong>{{ $devices }}</strong></h2>
                                    <p class="my-1 text-primary">My Active Devices</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-md-4">
                <a href="">
                    <div class="card border-0 mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <h1 class="m-0 text-success"><i class="fas fa-file-invoice"></i></h1>
                                </div>
                                <div class="col-9">
                                    @if (!empty($invoices))
                                        <h2 class="m-0"><strong>{{ $voucher_code->count() }}</strong></h2>
                                        <p class="my-1">Voucher Saya</p>
                                    @endif
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
                                    @if (!empty($invoices))
                                        <h2 class="m-0"><strong>{{ $voucher_code_winner->count() }}</strong></h2>
                                        <p class="my-1">Kemenangan Undian</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
        </div>
    </div>
@endsection
