@extends('layouts.app')

@push('styles')

<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

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

@section('page')
    My Devices
@endsection

@section('contents')

@if ($my_devices->count() > 0)
<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing d-none d-sm-none d-md-none d-lg-block d-xl-block">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table id="dataTable" class="table dt-table-hover small" style="width:100%">
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
                                    $colors = ['badge-success', 'badge-danger', 'badge-warning', 'badge-secondary', 'badge-info'];
                                    $random_color = array_rand($colors);

                                @endphp
                                @foreach ($device->device->device_sensor as $item)
                                        <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->sensor->name }}</div>
                                @endforeach
                            </td>
                            <td>
                                <center>
                                    <div class="switch-container">
                                        <input class="switch-input" type="checkbox" {{ $device->last_status == "ON" ? "checked" : "" }} device-id="{{ $device->device->device_id }}" name="switch">
                                        <div class="switch-button">
                                          <div class="switch-button-inside">
                                            <svg class="switch-icon off" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" clip-rule="evenodd" d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12ZM8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"/>
                                            </svg>
                                            <svg class="switch-icon on" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                              <rect x="2" y="7" width="12" height="2" rx="1"/>
                                            </svg>
                                          </div>
                                        </div>
                                    </div>
                                </center>
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
    </div>
</div>


<div class="container">
    <div class="d-block d-sm-block d-lg-none d-xl-none">

        <div class="accordion" id="accordionExample">
            @foreach ($my_devices as $device)


                <div class="card border-0 ">
                    <div class="card-header p-2">
                        <div class="row p-0">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <i class="bi bi-cpu-fill text-gradient"></i>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <a href="{{ route('customer.device.show', $device->device->device_id) }}" class="text-decoration-none">
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-truncate fw-bold text-primary">{{ $device->device->device_id }}</span>
                                        </div>
                                    </div>
                                    <p class="m-0 text-primary">
                                        {{ $device->name }}
                                    </p>
                                </a>

                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center p-0">
                                <div class="switch-container">
                                    <input class="switch-input" type="checkbox" {{ $device->last_status == "ON" ? "checked" : "" }} device-id="{{ $device->device->device_id }}" name="switch">
                                    <div class="switch-button">
                                      <div class="switch-button-inside">
                                        <svg class="switch-icon off" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12ZM8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"/>
                                        </svg>
                                        <svg class="switch-icon on" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="2" y="7" width="12" height="2" rx="1"/>
                                        </svg>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-body border-0  p-0">
                        <div class="card border-0">
                                <div class="card-header border-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-light btn-block text-left small btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne{{ $device->id }}" aria-expanded="true" aria-controls="collapseOne{{ $device->id }}">
                                        Option
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne{{ $device->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body small">
                                        <form action="{{ route('customer.device.update', $device->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                                <x-input type="text" field="Device Name" value="{{ $device->name }}"/>

                                                @foreach ($device->schedule as $schedule)
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="action" class="mb-2">Action</label><br>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="scheduled_action[]" {{ $schedule->action == "ON" ? "checked" : "" }} id="inlineRadio1" value="option1">
                                                                <label class="form-check-label" for="inlineRadio1">ON</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="scheduled_action[]" {{ $schedule->action == "ON" ? "checked" : "" }} id="inlineRadio2" value="option2">
                                                                <label class="form-check-label" for="inlineRadio2">OFF</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="scheduled_time" class="mb-2">Scheduled Time</label>
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
<script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    document.querySelector(".switch-input").addEventListener("change", () => {
        const audio = new Audio(
            "data:audio/mpeg;base64,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l66A+sBKsb3MK//SnKSoeEbwjlksu4Y6nUw8//swZPsA8awMWfghSAAAAA0gAAABCB0LYeAwQ4gAADSAAAAElUxBTUUzLjEwMFVVVVVVVVVVVVVVgRCAAnmjmEjpMKT//f6oUrbOjqnbawppb6P//2DCQVVMQU1FMy4xMDBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//swZPuA8etCV/kBHWAAAA0gAAABBxBTXeA8YoAAADSAAAAEVUxBTUUzLjEwMFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//sgZPyA8agY1vgLEKAAAA0gAAABBxDdV+KkToAAADSAAAAEVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7IGT0gPF8JNV4BxHQAAANIAAAAQUcZVOgCSfAAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+xBk9wzxTDJTaCASMgAADSAAAAEDIJ9QQAh2gAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7EGTtjfDOL1IYARUQAAANIAAAAQC4ATIAAAAAAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//sQZN2P8AAAf4AAAAgAAA0gAAABAAAB/gAAACAAADSAAAAEVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVU="
        );
        audio.play();

        if (navigator.vibrate) navigator.vibrate(50);
    });


    $(document).ready(() => {
        $('#dataTable').dataTable({
            responsive: true
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

        });

    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
@endpush
