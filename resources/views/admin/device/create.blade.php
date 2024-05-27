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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
@endpush

@section('title')
    Generate Device
@endsection

@section('pagenow')
    Generate Device
@endsection

@section('contents')
    <div class="container-fluid">

        <form action="{{ route('admin.device.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="widget-content widget-content-area blog-create-section">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-xxl-12 col-md-12 mb-4">
                                    <label for="device_category">Device Category</label>
                                    <select class="select2 form-select form-select-lg" name="device_category" id="device_category" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                        @endforeach
                                    </select>

                                    <div class="w-100 d-flex justify-content-end mt-2">
                                        <div class="text-center">
                                            <!-- Button trigger modal -->
                                            <a href="{{ route('admin.device.category.create') }}" class="text-success mb-2 mr-2" >
                                              Add New category
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <x-input type="number" field="Total Generate"/>
                            </div>
                        </div>

                        <div class="card card-body mb-4 border-primary">
                            <div class="row row_sensor">
                                <div class="form-group mb-3">
                                    <label for="sensor">Sensor 1</label>
                                    <select class="select2 form-select form-select-lg" name="sensor[]" id="sensor_1" required>
                                        <option value="">Select sensor 1</option>
                                        @foreach ($sensors as $sensor)
                                            <option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary mb-3" id="btn_add_sensor">
                                    Add Sensor
                                </button>
                            </div>

                        </div>




                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Ganerate New Devices</button>
                        </div>

                    </div>
                </div>



            </div>
        </form>

        <!-- Modal Create Category Device -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.device.category.store') }}" id="formDevicecategory" method="post">
                    @csrf
                    <div class="modal-body">
                    <x-input type="text" field="Name"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
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
            $( '.select2' ).select2( {
                theme: 'bootstrap-5',
            } );

            var i = 1;
            $('#btn_add_sensor').on('click', function () {
                i++;
                $(".row_sensor:last").after(`<div class="row row_sensor">
                            <i class="fas fa-minus-circle position-absolute text-danger hapus_sensor" style="left:-19px;cursor:pointer; margin-top: 45px"></i>

                                <div class="form-group mb-3">
                                    <label for="sensor">Sensor ${i}</label>
                                    <select class="select2 form-select form-select-lg" name="sensor[]" id="sensor_${i}" required>
                                        <option value="">Select sensor ${i}</option>
                                        @foreach ($sensors as $sensor)
                                            <option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                        </div>`);

                $(`#sensor_${i}`).select2( {
                    theme: 'bootstrap-5',
                } );
            });


            $(document).on('click', '.hapus_sensor', function () {
                $(this).closest('.row_sensor').remove();
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
