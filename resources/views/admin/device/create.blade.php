@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('title')
    Generate New Devices
@endsection

@section('page')
    Generate New Devices
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="card card-body border-0 shadow-sm">
            <form action="{{ route('admin.device.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mb-4 layout-spacing layout-top-spacing">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <div class="widget-content widget-content-area blog-create-section">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-xxl-12 col-md-12 mb-4">
                                        <label for="device_category" class="mb-2">Device Category</label>
                                        <select class="select2 form-select" name="device_category" id="device_category" required>
                                            <option value="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                            @endforeach
                                        </select>

                                        <div class="w-100 d-flex justify-content-end mt-2">
                                            <div class="text-center">
                                                <a href="{{ route('admin.device.category.create') }}" class="text-decoration-none text-primary mb-2 mr-2" >
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
                                        <label for="sensor" class="mb-2">Sensor 1</label>
                                        <select class="select2 form-select" name="sensor[]" id="sensor_1" required>
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
                                <button type="submit" class="btn btn-primary">Ganerate New Devices</button>
                            </div>

                        </div>
                    </div>



                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(() => {
            $( '.select2' ).select2( {
                theme: 'bootstrap-5',
            } );

            $('#summernote').summernote({
                placeholder: 'Type Description ...',
                tabsize: 2,
                height: 300
            });

            var i = 1;
            $('#btn_add_sensor').on('click', function () {
                i++;
                $(".row_sensor:last").after(`<div class="row row_sensor">
                            <i class="fas fa-minus-circle position-absolute text-danger hapus_sensor" style="left:-19px;cursor:pointer; margin-top: 45px"></i>

                                <div class="form-group mb-3">
                                    <label for="sensor" class="mb-2">Sensor ${i}</label>
                                    <select class="select2 form-select" name="sensor[]" id="sensor_${i}" required>
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
