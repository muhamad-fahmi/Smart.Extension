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
@endpush

@section('title')
    Create Device Category
@endsection

@section('pagenow')
    Create Device Category
@endsection

@section('contents')
    <div class="container-fluid">

        <form action="{{ route('admin.device.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="widget-content widget-content-area blog-create-section">

                        <x-input type="text" field="Device Name"/>
                        <div class="row">
                            <div class="col-md-6">
                                <x-input type="text" field="Device Price" classAdd="number-separator-rupiah"/>
                            </div>
                            <div class="col-md-6">
                                <x-input type="number" field="Device Stock"/>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label>Device Description</label>
                                <textarea id="summernote" cols="30" rows="10" name="device_description" required></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-3 cåol-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area blog-create-section">
                        <div class="row">

                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="image">Device Image</label>

                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                <button type="submit" class="btn btn-success w-100">Create Device Category</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal Create Category Product -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.device.category.store') }}" id="formProductcategory" method="post">
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
        });


        $(document).on("input", ".number-separator-rupiah", function(event) {
                let input = event.target.value;

                // Replace anything that is not a digit, decimal point, or hyphen
                let sanitizedInput = input.replace(/[^\d.-]/g, "");

                // Check if the input starts with a hyphen
                let isNegative = sanitizedInput.startsWith("-");

                // Remove any leading hyphens that are not followed by a digit
                sanitizedInput = sanitizedInput.replace(/(?!^)-+/g, '');

                // Split the input into integer and fractional parts
                let [integerPart, fractionalPart] = sanitizedInput.split('.');

                // Add commas for thousands separator in the integer part
                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // Limit fractional part to two decimal places
                if (fractionalPart !== undefined) {
                    fractionalPart = fractionalPart.slice(0, 2); // Limit to two decimal places
                    result = integerPart + "." + fractionalPart;
                } else {
                    result = integerPart;
                }

                // Prepend hyphen if the input was negative
                if (isNegative) {
                    result = result;
                }

                // Update the input field with the formatted result
                event.target.value = result;
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
