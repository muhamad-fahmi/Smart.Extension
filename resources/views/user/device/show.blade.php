@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
/>
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

<link rel="stylesheet" href="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

<link href="{{ asset('cork/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('cork/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('cork/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('cork/src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('cork/src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/light/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('cork/src/assets/css/dark/forms/switches.css') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">

<style>
    textarea.h-25 {
        height: 13rem !important;
    }
    .card {
        font-family: "Share Tech", sans-serif;
        font-weight: 400;
        font-style: normal;
    }
</style>
@endpush

@section('title')
    Detail Device {{ $device->device_id }}
@endsection

@section('pagenow')
    Detail Device <strong>{{ $device->device_id }}</strong>
@endsection

@section('contents')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-primary"><i class="fa-solid fa-clock"></i></h1>
                        </div>
                        <div class="col-9 d-flex align-items-center">
                            <h2 class="m-0"><strong id="clock">0</strong></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-primary"><i class="fa-solid fa-lightbulb"></i></h1>
                        </div>
                        <div class="col-9 d-flex align-items-center">
                            <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-label-toggle show">
                                <div class="input-checkbox">
                                    <span class="switch-chk-label label-left">OFF</span>
                                    <input class="switch-input" type="checkbox" role="switch" id="form-custom-switch-inner-label" name="switch" onchange="this.checked ? this.closest('.inner-label-toggle').classList.add('show') : this.closest('.inner-label-toggle').classList.remove('show')" checked>
                                    <span class="switch-chk-label label-right">ON</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-primary"><i class="fa-solid fa-temperature-three-quarters"></i></h1>
                        </div>
                        <div class="col-9">
                            <p class="my-1">Temperatur</p>
                            <h2 class="m-0"><strong id="temp_value">0</strong> °C</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-primary"><i class="fa-solid fa-droplet"></i></h1>
                        </div>
                        <div class="col-9">
                            <p class="my-1">Kelembaban</p>
                            <h2 class="m-0"><strong id="hum_value">0</strong> % RH</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-6 col-md-6 layout-top-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Temperatur</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div id="chartT"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 layout-top-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Kelembaban</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div id="chartH"></div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@push('scripts')
    <script src="{{ asset('cork/src/plugins/src/table/datatable/datatables.js') }}"></script>

    <script src="{{ asset('cork/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('cork/src/plugins/src/apex/apexcharts.min.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.1.0/mqttws31.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.1.0/paho-mqtt.min.js" integrity="sha512-Y5n0fbohPllOQ21fTwM/h9sQQ/1a1h5KhweGhu2zwD8lAoJnTgVa7NIrFa1bRDIMQHixtyuRV2ubIx+qWbGdDA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>



    {{-- <script src="{{ asset('cork/src/plugins/src/apex/custom-apexcharts.js') }}"></script> --}}

    <script>

        window.addEventListener("load", function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.LoadingOverlay('show');
            // MQTT Connection Configuration
            var mqttBroker = "{{ env('MQTT_HOST') }}";
            var mqttPort = 8884;
            var mqttTopicT = '{{ $device->device_id }}/sensor/dht22/t';
            var mqttTopicH = '{{ $device->device_id }}/sensor/dht22/h';
            var mqttUsername = "{{ env('MQTT_AUTH_USERNAME') }}";
            var mqttPassword = "{{ env('MQTT_AUTH_PASSWORD') }}";

            // Create a client instance
            var clientId = 'client_{{ $device->user_id }}';
            var client = new Paho.Client('wss://' + mqttBroker + ':' + mqttPort + '/mqtt', clientId);

            // Set callback handlers
            client.onConnectionLost = onConnectionLost;
            client.onMessageArrived = onMessageArrived;

            // client.username_pw_set(mqttUsername, mqttPassword)

            // Connect the client
            client.connect({
                onSuccess: onConnect,
                userName: mqttUsername,
                password: mqttPassword,
                useSSL: true
            });

            // Callback function executed when the client successfully connects
            function onConnect() {
                console.log("Connected to HiveMQ broker");
                // Subscribe to MQTT topics
                client.subscribe(mqttTopicT);
                client.subscribe(mqttTopicH);
                $.LoadingOverlay('hide');
            }

            // Callback function executed when the client loses its connection
            function onConnectionLost(responseObject) {
                if (responseObject && responseObject.errorCode !== undefined) {
                    console.log("Connection lost with error code:", responseObject.errorCode);
                    console.log("Error message:", responseObject.errorMessage);
                } else {
                    console.log("Connection lost with unknown error");
                }
            }

            // Callback function executed when a message arrives

            function onMessageArrived(message) {
                if (message.destinationName === mqttTopicT) {
                    console.log(`${message.destinationName} : ${message.payloadString}`);
                    $('#temp_value').text(message.payloadString);
                    updateChart('chartT', message.payloadString);
                } else if (message.destinationName === mqttTopicH) {
                    console.log(`${message.destinationName} : ${message.payloadString}`);
                    $('#hum_value').text(message.payloadString);
                    updateChart('chartH', message.payloadString);
                }
            }

            // Chart Configuration
            var optionsT = {
                chart: {
                    type: 'line',
                    height: 350,
                    animations: {
                        enabled: false
                    }
                },
                series: [{
                    name: 'Temperature Data',
                    data: []
                }],
                xaxis: {
                    type: 'datetime',
                    categories: []
                }
            };

            var optionsH = {
                chart: {
                    type: 'line',
                    height: 350,
                    animations: {
                        enabled: false
                    }
                },
                series: [{
                    name: 'Humidity Data',
                    data: []
                }],
                xaxis: {
                    type: 'datetime',
                    categories: []
                }
            };

            var chartT = new ApexCharts(document.querySelector("#chartT"), optionsT);
            var chartH = new ApexCharts(document.querySelector("#chartH"), optionsH);

            chartT.render();
            chartH.render();


            function getJakartaTime() {
                var now = new Date();
                var options = { timeZone: 'Asia/Jakarta', hour12: false };
                var jakartaTime = now.toLocaleString('en-US', options);
                var [date, time] = jakartaTime.split(', ');

                var [month, day, year] = date.split('/');
                var [hours, minutes, seconds] = time.split(':');

                // Format day, month, and year with leading zeros if needed
                day = day.padStart(2, '0');
                month = month.padStart(2, '0');
                year = year.padStart(4, '0');

                // Combine all parts into the desired format
                var formattedDateTime = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;

                return formattedDateTime;
            }


            var newDataT = [];
            var newDataH = [];

            var timestampT = [];
            var timestampH = [];


            // Update chart with new data
            function updateChart(chartId, data) {
                // Dapatkan timestamp saat ini dalam milidetik
                var currentTimestamp = new Date().getTime();

                // Dapatkan offset zona waktu Jakarta dari UTC dalam menit
                var jakartaOffset = -420; // Jakarta UTC+7, offset dalam menit

                // Dapatkan offset zona waktu lokal dari UTC dalam menit
                var localOffset = new Date().getTimezoneOffset();

                // Hitung timestamp di zona waktu Jakarta
                var timestamp = moment.tz('Asia/Jakarta').valueOf();

                if (chartId === 'chartT') {
                    try {
                        newDataT.push(parseFloat(data));
                        timestampT.push(timestamp);
                    } catch (e) {
                        console.error("Failed to parse data:", data);
                        return;
                    }

                    chartT.updateSeries([{
                        data: newDataT,
                    }], true);

                    chartT.updateOptions({
                        xaxis: {
                            categories: timestampT
                        }
                    }, true);

                } else if (chartId === 'chartH') {
                    try {
                        newDataH.push(parseFloat(data));
                        timestampH.push(timestamp);
                    } catch (e) {
                        console.error("Failed to parse data:", data);
                        return;
                    }

                    chartH.updateSeries([{
                        data: newDataH,
                    }], true);

                    chartH.updateOptions({
                        xaxis: {
                            categories: timestampH
                        }
                    }, true);
                }
            }

            function updateTime() {
                var jakartaTime = moment().tz("Asia/Jakarta").format('DD/MM/YYYY HH:mm:ss');
                document.getElementById('clock').innerText = jakartaTime;
            }

            // Update time every second
            setInterval(updateTime, 1000);

            // Initial call to display the time immediately on load
            updateTime();


            $('input[name=switch]').on('change', function () {
                $.LoadingOverlay('show');

                var status = $(this).is(':checked');

                var device_id = "{{ $device->device_id }}";
                $.ajax({
                    url: route('customer.device.pub', {
                        'device_id' : device_id,
                        'switch' : status
                    }), // The URL to make the request to
                    type: 'POST', // The HTTP method to use
                    // data: JSON.stringify({ key1: 'value1', key2: 'value2' }), // The data to send in the request body
                    // contentType: 'application/json', // The content type of the data being sent
                    // dataType: 'json', // The type of data you're expecting back from the server
                    success: function(response) {
                        // This function will be called if the request is successful
                        console.log('Success:', response);
                        $.LoadingOverlay('hide');

                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil menyalakan lampu'
                        });

                    },
                    error: function(xhr, status, error) {
                        // This function will be called if there is an error with the request
                        console.error('Error:', error);

                        Toast.fire({
                            icon: 'error',
                            title: error
                        });
                        
                    }
                });

            })

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

