@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
@endpush

@section('title')
    Devices
@endsection


@section('page')
    Devices
@endsection

@section('contents')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table id="dataTable" class="table dt-table-hover small" style="width:100%">
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
                    <td><a href="{{ route('admin.device.show_by_category', $device->category->slug) }}" class="text-decoration-none text-primary">{{ ucwords($device->category->name) }}</a></td>
                    <td>
                        @php
                            $colors = ['badge-success', 'badge-danger', 'badge-warning', 'badge-secondary', 'badge-info'];
                            $random_color = array_rand($colors);

                        @endphp
                        @foreach ($device->device_sensor as $item)
                            <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->sensor->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @if ($device->status == true)
                            <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Not Active</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#activateModal{{ $device->id }}">Activate</button>

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
                                                        $colors = ['badge-success', 'badge-danger', 'badge-warning', 'badge-secondary', 'badge-info'];
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

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $device->id }}">Delete</button>

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
<script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>

<script>
    $(document).ready(() => {
        $('#dataTable').dataTable({
            responsive: true
        });
    })
</script>
@endpush
