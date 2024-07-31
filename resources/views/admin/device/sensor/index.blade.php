@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
@endpush

@section('title')
    Product Sensor
@endsection

@section('page')
    Product Sensor
@endsection

@section('contents')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table id="dataTable" class="table dt-table-hover small" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Params</th>
                    <th>Created At</th>
                    <th class="no-content text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($sensors as $sensor)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="d-flex flex-column">
                                <span class="text-truncate fw-bold">
                                    <a href="" class="text-decoration-none">{{ ucwords($sensor->name) }}</a>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $colors = ['badge-success', 'badge-danger', 'badge-warning', 'badge-secondary', 'badge-info'];
                            $random_color = array_rand($colors);

                        @endphp
                        @foreach ($sensor->params as $item)
                            <div class="badge {{ $colors[$random_color] }} mr-2"><strong>{{ $item->key }}</strong> : {{ $item->type }}</div>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($sensor->updated_at)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.device.sensor.edit', $sensor->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $sensor->id }}">Delete</button>

                        <!-- Modal Create Sensor Product -->
                        <div class="modal fade" id="deleteModal{{ $sensor->id }}" tabindex="-1" aria-labelledby="deleteModal{{ $sensor->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="deleteModal{{ $sensor->id }}Label">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.device.sensor.delete', $sensor->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body text-left">
                                    <p class="my-3" style="text-align: left">Will you delete selected device sensor item data ? </p>

                                    <table class="table table-sm " style="text-align: left">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $sensor->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>{{ $sensor->price }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <img src="{{ asset('assets/devices/images/'.$sensor->image) }}" alt="" class="w-100 rounded mb-4">
                                            </td>
                                        </tr>

                                    </table>
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
