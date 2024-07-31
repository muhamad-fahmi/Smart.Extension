@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

@section('title')
    Add New Device
@endsection

@section('page')
    Add New Device
@endsection

@section('contents')
    <div class="container-fluid">

        <div class="card card-body shadow-sm border-0">
            <form action="{{ route('customer.device.create') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mb-4 layout-spacing layout-top-spacing">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <div class="widget-content widget-content-area blog-create-section">

                            <div class="form-group mb-3">
                                <label for="device_category" class="mb-2">Device Category</label>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="validate_id" placeholder="Enter Device ID">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary rounded-0 rounded-end w-100" disabled id="btn_validate">Validate</button>
                                    </div>
                                </div>

                                <div id="validate_msg" class="my-3" style="display: none;">
                                    <div class="badge badge-light-success">

                                    </div>
                                </div>

                            </div>



                            <x-input type="text" field="Device Name" disabled required/>

                            <div class="row mb-3 scheduled-action" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="action">Action</label><br>

                                        <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                            <div class="input-checkbox">
                                                <span class="switch-chk-label label-left">ON</span>
                                                <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-text" name="scheduled_action[]">
                                                <span class="switch-chk-label label-right">OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="scheduled_time">Scheduled Time (ex: 12:00)</label>
                                        <input type="text" name="scheduled_time[]" class="form-control" placeholder="Ex: 12:00">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4 scheduled-action" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="action">Action</label><br>

                                        <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                            <div class="input-checkbox">
                                                <span class="switch-chk-label label-left">ON</span>
                                                <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-text" name="scheduled_action[]">
                                                <span class="switch-chk-label label-right">OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="scheduled_time">Scheduled Time (ex: 14:00)</label>
                                        <input type="text" name="scheduled_time[]" class="form-control" placeholder="Ex: 14:00">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end" id="btn_submit" style="display: none">
                                <button type="submit" class="btn btn-success" disabled>Ganerate New Devices</button>
                            </div>

                        </div>
                    </div>



                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(() => {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( '.select2' ).select2( {
                theme: 'bootstrap-5',
            } );

            $('input[name=validate_id]').on('input', function () {
                var value = $(this).val();

                if (value) {
                    $('#btn_validate').attr('disabled', false);
                } else {
                    $('#btn_validate').attr('disabled', true);
                }
            });


            $('#btn_validate').on('click', function() {
                var id_device = $('input[name=validate_id]').val();

                $.get(route('customer.device.validate', id_device), function(response) {
                    console.log(response)
                    if (response.status == 1) {
                        toastr["success"](response.msg);
                        $('#validate_msg').show();
                        $('.scheduled-action').show();
                        $('input[name=validate_id]').addClass('is-valid');
                        $('#validate_msg .badge').removeClass('badge-light-danger').addClass('badge-light-success');
                        $('#validate_msg .badge').text(response.msg);
                        $('#btn_submit').show();
                        $('#btn_submit button').attr('disabled', false);
                        $('input[name=device_name]').attr('disabled', false);
                    } else {
                        toastr["error"](response.msg);
                        $('#validate_msg').show();
                        $('.scheduled-action').hide();
                        $('input[name=validate_id]').removeClass('is-valid').addClass('is-invalid');
                        $('#validate_msg .badge').removeClass('badge-light-success').addClass('badge-light-danger');
                        $('#validate_msg .badge').text(response.msg);
                        $('#btn_submit').hide();
                        $('#btn_submit button').attr('disabled', true);
                        $('input[name=device_name]').attr('disabled', true);
                    }
                });
            });

        });

    </script>
@endpush
