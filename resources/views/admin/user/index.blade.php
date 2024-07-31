@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
@endpush

@section('title')
    Manage Users
@endsection


@section('page')
    Manage Users
@endsection

@section('contents')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table id="dataTable" class="table dt-table-hover small" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Whatsapp</th>
                    <th>Total Devices</th>
                    <th>Status</th>
                    <th class="no-content text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach ($users as $user)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->whatsapp }}</td>
                    <td>{{ $user->devices->count() }}</td>
                    <td>
                        @if (!empty($user->email_verified_at))
                            <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Not Active</div>
                        @endif
                    </td>
                    <td class="text-center">

                        @if ($user->status == 1)
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#disableModal{{ $user->id }}">Disable</button>

                        <!-- Modal Disable -->
                        <div class="modal fade" id="disableModal{{ $user->id }}" tabindex="-1" aria-labelledby="disableModal{{ $user->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="disableModal{{ $user->id }}Label">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.user.disable', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body"  style="text-align: left">
                                        <p class="my-3">Will you disable selected user ? </p>
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Email</th>
                                                <td>: {{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Whatsapp</th>
                                                <td>: {{ $user->whatsapp }}</td>
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

                        @else
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#enableModal{{ $user->id }}">Enable</button>

                        <!-- Modal enable -->
                        <div class="modal fade" id="enableModal{{ $user->id }}" tabindex="-1" aria-labelledby="enableModal{{ $user->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="enableModal{{ $user->id }}Label">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.user.enable', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body"  style="text-align: left">
                                        <p class="my-3">Will you enable selected user ? </p>
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Email</th>
                                                <td>: {{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Whatsapp</th>
                                                <td>: {{ $user->whatsapp }}</td>
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
                        @endif


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
