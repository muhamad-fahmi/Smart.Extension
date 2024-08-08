@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('title')
    Create Device Category
@endsection

@section('page')
    Create Device Category
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="card card-body border-0 shadow-sm">
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
                                    <label class="mb-2">Device Description</label>
                                    <textarea id="summernote" cols="30" rows="10" name="device_description" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-3 cåol-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                        <div class="widget-content widget-content-area blog-create-section">
                            <div class="row">

                                <div class="col-xxl-12 col-md-12 mb-4">
                                    <label for="image" class="mb-2">Device Image</label>

                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                    <button type="submit" class="btn btn-outline-primary w-100">
                                        <i class="bi bi-floppy mr-2"></i>Create Device Category
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>

        $(document).ready(() => {
            $('#summernote').summernote({
                placeholder: 'Type Description ...',
                tabsize: 2,
                height: 300
            });
        })


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
