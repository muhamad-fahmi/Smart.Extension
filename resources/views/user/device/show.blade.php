@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
/>
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

<link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<style>
    textarea.h-25 {
        height: 13rem !important;
    }
</style>
@endpush

@section('title')
    Detail Device {{ $device->device_id }}
@endsection

@section('pagenow')
    Detail Device <strong>{{ $device->device_id }}</strong>
@endsection

@section('contents')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    {{-- <div class="card border-0 mb-4">
        <div class="card-body">
            <table class="table mb-0">
                <tr>
                    <th style="width: 200px;">Event Name</th>
                    <td>{{ ucwords($voucher->name) }}</td>
                </tr>
                @if (!empty($voucher_codes[0]->voucher->winner[0]->created_at))
                <tr>
                    <th style="width: 100px;">Event Date</th>
                    <td>{{\Carbon\Carbon::parse( $voucher_codes[0]->voucher->winner[0]->created_at)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th style="width: 100px;">Event Status</th>
                    <td>Ended</td>
                </tr>
                @endif
            </table>
        </div>
    </div> --}}



</div>
@endsection

@push('scripts')
    <script src="{{ asset('cork/src/plugins/src/table/datatable/datatables.js') }}"></script>

    <script src="{{ asset('cork/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>

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

