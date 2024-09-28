@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.51.0/apexcharts.min.css" integrity="sha512-n+A0Xug6+j9/fCBVPoCihITLoICIB2FTqjESx+kwYdF5bzpblXz11zaILuLYmN3yk2WyMTw53sah9tTiojgySg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    Device {{ $device->device_id }}
@endsection

@section('page')
    Device <strong>{{ $device->device_id }}</strong>
@endsection

@section('contents')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient"><i class="fa-solid fa-clock"></i></h1>
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
                            <h1 class="m-0 text-gradient"><i class="fa-solid fa-lightbulb"></i></h1>
                        </div>
                        <div class="col-9 d-flex align-items-center">
                            <center>
                                <div class="switch-container">
                                    <input class="switch-input" type="checkbox" {{ $device->user[0]->last_status == "ON" ? "checked" : "" }} device-id="{{ $device->user[0]->device->device_id }}" name="switch">
                                    <div class="switch-button">
                                      <div class="switch-button-inside">
                                        <svg class="switch-icon off" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12ZM8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"/>
                                        </svg>
                                        <svg class="switch-icon on" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="2" y="7" width="12" height="2" rx="1"/>
                                        </svg>
                                      </div>
                                    </div>
                                </div>
                            </center>
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
                    <div class="d-flex justify-content-center align-items-center loader-t mx-auto my-4">
                        <div class="spinner-border text-primary align-self-center"></div>
                    </div>


                    <div class="row dht-t-result" style="display: none;">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient"><i class="fa-solid fa-temperature-three-quarters"></i></h1>
                        </div>
                        <div class="col-9">
                            <p class="my-1">Temperature</p>
                            <h2 class="m-0"><strong id="temp_value">0</strong> °C</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 mb-2">
                <div class="card-body">

                    <div class="d-flex justify-content-center align-items-center loader-h mx-auto my-4">
                        <div class="spinner-border text-primary align-self-center"></div>
                    </div>

                    <div class="row dht-h-result"  style="display: none;">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                            <h1 class="m-0 text-gradient"><i class="fa-solid fa-droplet"></i></h1>
                        </div>
                        <div class="col-9">
                            <p class="my-1">Humidity</p>
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
                            <h4>Temperature</h4>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center loader-t mx-auto py-4">
                    <div class="spinner-border text-primary align-self-center"></div>
                </div>

                <div class="widget-content widget-content-area dht-t-result"  style="display: none;">
                    <div id="chartT"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 layout-top-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Humidity</h4>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center loader-h mx-auto py-4">
                    <div class="spinner-border text-primary align-self-center"></div>
                </div>

                <div class="widget-content widget-content-area dht-h-result"  style="display: none;">
                    <div id="chartH"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 ">

            <div class="card card-body alert-danger border-danger">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalResetWifi">
                    <i class="fas fa-wifi mr-3"></i> Reset Wi-Fi Connection
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalResetWifi" tabindex="-1" aria-labelledby="modalResetWifiLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset Wi-Fi</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <p class="my-1">Will you reset the Wi-Fi connection?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <form action="{{ route('customer.device.reset', $device->device_id) }}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-primary">Continue</button>
                        </form>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.51.0/apexcharts.min.js" integrity="sha512-rgvuw7+rpm6cEJOUFmmzb2UWUVWg2VkIbmw6vMoWjbX/7CsyPgiMvrXhzZJbS0Ow1Bq/3illaZaqQej1n3AA7Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.1.0/mqttws31.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.1.0/paho-mqtt.min.js" integrity="sha512-Y5n0fbohPllOQ21fTwM/h9sQQ/1a1h5KhweGhu2zwD8lAoJnTgVa7NIrFa1bRDIMQHixtyuRV2ubIx+qWbGdDA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>



    {{-- <script src="{{ asset('cork/src/plugins/src/apex/custom-apexcharts.js') }}"></script> --}}

    <script>

        document.querySelector(".switch-input").addEventListener("change", () => {
            const audio = new Audio(
                "data:audio/mpeg;base64,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l66A+sBKsb3MK//SnKSoeEbwjlksu4Y6nUw8//swZPsA8awMWfghSAAAAA0gAAABCB0LYeAwQ4gAADSAAAAElUxBTUUzLjEwMFVVVVVVVVVVVVVVgRCAAnmjmEjpMKT//f6oUrbOjqnbawppb6P//2DCQVVMQU1FMy4xMDBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//swZPuA8etCV/kBHWAAAA0gAAABBxBTXeA8YoAAADSAAAAEVUxBTUUzLjEwMFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//sgZPyA8agY1vgLEKAAAA0gAAABBxDdV+KkToAAADSAAAAEVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7IGT0gPF8JNV4BxHQAAANIAAAAQUcZVOgCSfAAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+xBk9wzxTDJTaCASMgAADSAAAAEDIJ9QQAh2gAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7EGTtjfDOL1IYARUQAAANIAAAAQC4ATIAAAAAAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//sQZN2P8AAAf4AAAAgAAA0gAAABAAAB/gAAACAAADSAAAAEVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVU="
            );
            audio.play();

            if (navigator.vibrate) navigator.vibrate(50);
        });

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

                    $('.dht-h-result').hide();
                    $('.loader-h').addClass('d-flex').removeClass('d-none').hide();

                    $('.dht-t-result').hide();
                    $('.loader-t').addClass('d-flex').removeClass('d-none').hide();

                    setInterval(() => {
                        toastr['error'](responseObject.errorMessage)

                    }, 5000);

                    $.LoadingOverlay('show');

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
                    $('.dht-t-result').show();
                    $('.loader-t').removeClass('d-flex').addClass('d-none').hide();
                } else if (message.destinationName === mqttTopicH) {
                    console.log(`${message.destinationName} : ${message.payloadString}`);
                    $('#hum_value').text(message.payloadString);
                    updateChart('chartH', message.payloadString);
                    $('.dht-h-result').show();
                    $('.loader-h').removeClass('d-flex').addClass('d-none').hide();
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

                        if (status === true) {
                            toastr['success']('Berhasil menyalakan lampu')

                            $('.form-switch-primary').addClass('show');

                            $('#form-custom-switch-inner-label').attr('checked', true);
                        } else {


                            toastr['success']('Berhasil mematikan lampu')

                            $('.form-switch-primary').removeClass('show');

                            $('#form-custom-switch-inner-label').attr('checked', false);
                        }

                    },
                    error: function(xhr, status, error) {
                        // This function will be called if there is an error with the request
                        console.error('Error:', error);
                        toastr['error'](error)

                    }
                });

            })

        });
    </script>
@endpush

