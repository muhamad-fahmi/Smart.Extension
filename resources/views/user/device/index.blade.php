@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">


<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/light/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/dark/forms/switches.css') }}">

<link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

<style>
    #blog-list img {
        border-radius: 18px;
    }
    .btn-warning {
        color: #000;
        background-color: #ffde07;
        border-color: #ffde07;
        font-weight: bold;
    }
</style>
@endpush

@section('title')
    My Devices
@endsection

@section('pagenow')
    My Devices
@endsection

@section('contents')

@if ($my_devices->count() > 0)
<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing d-none d-sm-none d-md-none d-lg-block d-xl-block">
    <div class="widget-content widget-content-area br-8">
        <table id="blog-list" class="table dt-table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Device</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sensor</th>
                    <th>Switch</th>
                    <th class="no-content text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($my_devices as $device)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>
                        <a href="{{ route('customer.device.show', $device->device->device_id) }}" class="text-decoration-none">
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="d-flex flex-column">
                                    <span class="text-truncate fw-bold">{{ $device->device->device_id }}</span>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->device->category->name }}</td>
                    <td>
                        @php
                            $colors = ['badge-light-success', 'badge-light-danger', 'badge-light-warning', 'badge-light-secondary', 'badge-light-info'];
                            $random_color = array_rand($colors);

                        @endphp
                        @foreach ($device->device->device_sensor as $item)
                                <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->sensor->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-icon-toggle">
                            <div class="input-checkbox">
                                <span class="switch-chk-label label-left"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.995 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007-2.246-5.007-5.007-5.007S6.995 9.239 6.995 12zM11 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2H2zm17 0h3v2h-3zM5.637 19.778l-1.414-1.414 2.121-2.121 1.414 1.414zM16.242 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.344 7.759 4.223 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"></path></svg></span>
                                <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-icon" {{ $device->last_status == "ON" ? "checked" : "" }} device-id="{{ $device->device->device_id }}" name="switch">
                                <span class="switch-chk-label label-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 11.807A9.002 9.002 0 0 1 10.049 2a9.942 9.942 0 0 0-5.12 2.735c-3.905 3.905-3.905 10.237 0 14.142 3.906 3.906 10.237 3.905 14.143 0a9.946 9.946 0 0 0 2.735-5.119A9.003 9.003 0 0 1 12 11.807z"></path></svg></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">

                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $device->id }}">Edit</a>

                        <!-- Modal Create Category News -->
                        <div class="modal fade" id="editModal{{ $device->id }}" tabindex="-1" aria-labelledby="editModal{{ $device->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="editModal{{ $device->id }}Label">Edit Device</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('customer.device.update', $device->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <x-input type="text" field="Device Name" value="{{ $device->name }}"/>

                                        @foreach ($device->schedule as $schedule)
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="action">Action</label><br>

                                                    <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                                        <div class="input-checkbox">
                                                            <span class="switch-chk-label label-left">ON</span>
                                                            <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-text" name="scheduled_action[]" {{ $schedule->action == "ON" ? "checked" : "" }}>
                                                            <span class="switch-chk-label label-right">OFF</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="scheduled_time">Scheduled Time (ex: 12:00)</label>
                                                    <input type="text" name="scheduled_time[]" class="form-control" placeholder="Ex: 12:00" value="{{ $schedule->scheduled_time }}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Continue</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>



                        <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $device->id }}">Delete</a>

                        <!-- Modal Create Category News -->
                        <div class="modal fade" id="deleteModal{{ $device->id }}" tabindex="-1" aria-labelledby="deleteModal{{ $device->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="deleteModal{{ $device->id }}Label">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('customer.device.delete', $device->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                    <p class="my-3">Will you delete selected device item ? <strong>ID {{ $device->device->device_id }}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Continue</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container-fluid">
    <div class="d-block d-sm-block d-lg-none d-xl-none">
        <div class="accordion" id="accordionExample">
            @foreach ($my_devices as $device)
                <div class="card">
                    <div class="card-header p-2">
                        <div class="row p-0">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-house-laptop"></i>
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <a href="{{ route('customer.device.show', $device->device->device_id) }}" class="text-decoration-none">
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-truncate fw-bold">{{ $device->device->device_id }}</span>
                                        </div>
                                    </div>
                                    <p class="m-0">
                                        {{ $device->name }}
                                    </p>
                                </a>

                            </div>
                            <div class="col-2 d-flex justify-content-end align-items-center p-0">
                                <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-icon-toggle">
                                    <div class="input-checkbox">
                                        <span class="switch-chk-label label-left"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.995 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007-2.246-5.007-5.007-5.007S6.995 9.239 6.995 12zM11 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2H2zm17 0h3v2h-3zM5.637 19.778l-1.414-1.414 2.121-2.121 1.414 1.414zM16.242 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.344 7.759 4.223 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"></path></svg></span>
                                        <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-icon" {{ $device->last_status == "ON" ? "checked" : "" }} device-id="{{ $device->device->device_id }}" name="switch">
                                        <span class="switch-chk-label label-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 11.807A9.002 9.002 0 0 1 10.049 2a9.942 9.942 0 0 0-5.12 2.735c-3.905 3.905-3.905 10.237 0 14.142 3.906 3.906 10.237 3.905 14.143 0a9.946 9.946 0 0 0 2.735-5.119A9.003 9.003 0 0 1 12 11.807z"></path></svg></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $device->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $device->id }}" aria-expanded="false" aria-controls="collapseOne{{ $device->id }}">
                                    Option
                                </button>
                            </h2>
                            <div id="collapseOne{{ $device->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $device->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="{{ route('customer.device.update', $device->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                            <x-input type="text" field="Device Name" value="{{ $device->name }}"/>

                                            @foreach ($device->schedule as $schedule)
                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="action">Action</label><br>

                                                        <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                                            <div class="input-checkbox">
                                                                <span class="switch-chk-label label-left">ON</span>
                                                                <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-text" name="scheduled_action[]" {{ $schedule->action == "ON" ? "checked" : "" }}>
                                                                <span class="switch-chk-label label-right">OFF</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="scheduled_time">Scheduled Time</label>
                                                        <input type="text" name="scheduled_time[]" class="form-control" placeholder="Ex: 12:00" value="{{ $schedule->scheduled_time }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        <div class="d-flex justify-content-end my-3">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>

        <!-- Modal Update Voucher -->
        <div class="modal fade text-left" id="updateModal" >
            <div class="modal-dialog">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" id="updateModalLabel">Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="formEditInv" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="text-align: left">
                        <x-input type="text" field="No Invoice" value=""/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Voucher -->
        <div class="modal fade" id="deleteModal" >
            <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="deleteModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                    <p class="my-3">Will you delete selected invoice data ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Continue</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                Anda tidak memiliki device apapun di Smart.Extension
            </div>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script src="{{ asset('cork/src/plugins/src/table/datatable/datatables.js') }}"></script>

<script src="{{ asset('cork/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
<script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>

<script>

    $(document).ready(() => {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    blogList = $('#blog-list').DataTable({
        headerCallback:function(e, a, t, n, s) {

        },
        columnDefs:[ {

        }],
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });

        $('#btn_edit').click((e) => {
            var id = $('#btn_edit').data('id');
            var invoice = $('#btn_edit').data('invoice');
            $('#updateModal').modal('show');
            $('#formEditInv').attr('action', route('customer.invoice_submit.update', id));
            $('#formEditInv #no_invoice').val(invoice);

        })

        $('#btn_delete').click((e) => {
            var id = $('#btn_delete').data('id');
            $('#deleteModal').modal('show');
            $('#deleteModal form').attr('action', route('customer.invoice_submit.delete', id));

        });

        $('input[name=switch]').on('change', function () {
                $.LoadingOverlay('show');

                var status = $(this).is(':checked');

                var device_id = $(this).attr('device-id');

                $.ajax({
                    url: route('customer.device.pub', {
                        'device_id' : device_id,
                        'switch' : status
                    }), // The URL to make the request to
                    type: 'POST', // The HTTP method to use
                    // data: JSON.stringify({ key1: 'value1', key2: 'value2' }), // The data to send in the request body
                    // contentType: 'application/json', // The content type of the data being sent
                    // dataType: 'json', // The type of data you're expecting back from the server
                    success: function(response) {
                        // This function will be called if the request is successful
                        console.log('Success:', response);
                        $.LoadingOverlay('hide');

                        if (status === true) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil menyalakan lampu'
                            });
                        } else {

                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil mematikan lampu'
                            });

                        }


                    },
                    error: function(xhr, status, error) {
                        // This function will be called if there is an error with the request
                        console.error('Error:', error);

                        Toast.fire({
                            icon: 'error',
                            title: error
                        });

                    }
                });

            })



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
<!-- END PAGE LEVEL SCRIPTS -->
@endpush
