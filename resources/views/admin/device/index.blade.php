@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

<link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<style>
    #blog-list img {
        border-radius: 18px;
    }
</style>
@endpush

@section('title')
    Products
@endsection

@section('pagenow')
    Products
@endsection

@section('contents')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="widget-content widget-content-area br-8">
        <table id="blog-list" class="table dt-table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Device ID</th>
                    <th>Category</th>
                    <th>Sensors</th>
                    <th>Status</th>
                    <th class="no-content text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($devices as $device)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="d-flex flex-column">
                                <span class="text-truncate fw-bold">{{ ucwords($device->device_id) }}</span>
                            </div>
                        </div>
                    </td>
                    <td><a href="{{ route('admin.device.show_by_category', $device->category->slug) }}">{{ ucwords($device->category->name) }}</a></td>
                    <td>
                        @php
                            $colors = ['badge-light-success', 'badge-light-danger', 'badge-light-warning', 'badge-light-secondary', 'badge-light-info'];
                            $random_color = array_rand($colors);

                        @endphp
                        @foreach ($device->device_sensor as $item)
                            <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->sensor->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @if ($device->status == true)
                            <div class="badge badge-light-success">Active</div>
                        @else
                            <div class="badge badge-light-danger">Not Active</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#activateModal{{ $device->id }}">Activate</a>

                        <!-- Modal Create Category News -->
                        <div class="modal fade" id="activateModal{{ $device->id }}" tabindex="-1" aria-labelledby="activateModal{{ $device->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="activateModal{{ $device->id }}Label">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.device.update', $device->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body"  style="text-align: left">
                                        <p class="my-3">Will you acticate selected device item ? </p>
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Device ID</th>
                                                <td>: {{ $device->device_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>: {{ $device->category->name }}</td>
                                            </tr><tr>
                                                <th>Sensor</th>
                                                <td>:
                                                    @php
                                                        $colors = ['badge-light-success', 'badge-light-danger', 'badge-light-warning', 'badge-light-secondary', 'badge-light-info'];
                                                        $random_color = array_rand($colors);

                                                    @endphp
                                                    @foreach ($device->device_sensor as $item)
                                                        <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->sensor->name }}</div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Continue</button>
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
                                <form action="{{ route('admin.device.delete', $device->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                    <p class="my-3">Will you delete selected device item ? </p>
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
@endsection

@push('scripts')
<script src="{{ asset('cork/src/plugins/src/table/datatable/datatables.js') }}"></script>

<script src="{{ asset('cork/src/assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
<script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>

<script>
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