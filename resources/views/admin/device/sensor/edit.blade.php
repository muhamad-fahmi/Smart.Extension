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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{ asset('cork/src/assets/css/light/apps/blog-create.css') }}">
    <link rel="stylesheet" href="{{ asset('cork/src/assets/css/dark/apps/blog-create.css') }}">
    <!--  END CUSTOM STYLE FILE  -->
@endpush

@section('title')
    Edit Device Sensor
@endsection

@section('pagenow')
    Edit Device Sensor
@endsection

@section('contents')
    <div class="container-fluid">

        <form action="{{ route('admin.device.sensor.update', $sensor->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="widget-content widget-content-area blog-create-section">

                        <x-input type="text" field="Sensor Name" value="{{ $sensor->name }}"/>

                        <div class="card card-body mb-4 border-primary">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($sensor->params as $item)
                            <div class="row row_params">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="param_key">Param Key {{ $i }}</label>
                                        <input type="text" class="form-control" name="param_key[]" id="param_key_{{ $i }}" placeholder="Enter Param Key Without Space" required value="{{ $item->key }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="param_type">Param Type {{ $i }}</label>
                                        <select class="select2 form-select form-select-lg" name="param_type[]" id="param_type_{{ $i }}" required>
                                            <option value="">Select param type</option>
                                            <option {{ $item->type == "string" ? "selected" : "" }} value="string">String</option>
                                            <option {{ $item->type == "int" ? "selected" : "" }} value="int">Int</option>
                                            <option {{ $item->type == "float" ? "selected" : "" }} value="float">Float</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            @php
                                $i++;
                            @endphp

                            @endforeach

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary mb-3" id="btn_add_param">
                                    Add Parameter
                                </button>
                            </div>

                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label>Sensor Description</label>
                                <textarea id="summernote" cols="30" rows="7" name="sensor_description" required>{!! $sensor->description !!}</textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <label>Sensor Code</label>
                                <textarea id="summernote" class="code" cols="30" rows="7" name="sensor_code" required>{!! $sensor->code !!}</textarea>
                            </div>
                        </div>

                        <div class="col-xxl-12 col-md-12 mb-4 d-flex flex-column">
                            <label for="image">Sensor Image</label>

                            <img src="{{ asset('assets/sensor/images/'.$sensor->image) }}" alt="" class="w-25 rounded rounded-4 my-3">

                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                            <button type="submit" class="btn btn-success w-100">Edit Device Sensor</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

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

            $("#summernote.code").summernote({
                placeholder: "Example arduiono code",
                tabsize: 2,
                height: 350,
                codemirror: { // codemirror options
                    theme: 'monokai'
                }
            });

            var i = 1;
            $('#btn_add_param').on('click', function () {
                i++;
                $(".row_params:last").after(`<div class="row row_params">
                            <div class="col-md-6">
                                <i class="fas fa-minus-circle position-absolute text-danger hapus_param" style="left:-8px;cursor:pointer; margin-top: 45px"></i>

                                <div class="form-group mb-3">
                                    <label for="param_key">Param Key ${i}</label>
                                    <input type="text" class="form-control" name="param_key[]" id="param_key_${i}" placeholder="Enter Param Key Without Space">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="param_type">Param Type ${i}</label>
                                    <select class="select2 form-select form-select-lg" name="param_type[]" id="param_type_${i}" required>
                                        <option value="">Select param type</option>
                                        <option value="string">String</option>
                                        <option value="int">Int</option>
                                        <option value="float">Float</option>
                                    </select>

                                </div>
                            </div>
                        </div>`);
            });


            $(document).on('click', '.hapus_param', function () {
                $(this).closest('.row_params').remove();
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
