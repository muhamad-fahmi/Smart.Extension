@extends('layouts.app')

@push('styles')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset('cork/src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

    <link href="{{ asset('cork/src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('cork/src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{ asset('cork/src/assets/css/light/apps/blog-create.css') }}">
    <link rel="stylesheet" href="{{ asset('cork/src/assets/css/dark/apps/blog-create.css') }}">
    <!--  END CUSTOM STYLE FILE  -->

    <link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/light/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/dark/forms/switches.css') }}">
@endpush

@section('title')
    Add New Device
@endsection

@section('pagenow')
    Add New Device
@endsection

@section('contents')
    <div class="container-fluid">

        <form action="{{ route('customer.device.create') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="widget-content widget-content-area blog-create-section">

                        <div class="form-group mb-3">
                            <label for="device_category">Device Category</label>

                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="validate_id" placeholder="Enter Device ID">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn-lg btn btn-primary w-100" disabled id="btn_validate">Validate</button>
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{ asset('cork/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>

    <script src="{{ asset('cork/src/assets/js/apps/blog-create.js') }}"></script>

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
                        $('#validate_msg').show();
                        $('.scheduled-action').show();
                        $('input[name=validate_id]').addClass('is-valid');
                        $('#validate_msg .badge').removeClass('badge-light-danger').addClass('badge-light-success');
                        $('#validate_msg .badge').text(response.msg);
                        $('#btn_submit').show();
                        $('#btn_submit button').attr('disabled', false);
                        $('input[name=device_name]').attr('disabled', false);
                    } else {
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
