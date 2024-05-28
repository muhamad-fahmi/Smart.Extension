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

<style>
    textarea.h-25 {
        height: 13rem !important;
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


    {{-- <script src="{{ asset('cork/src/plugins/src/apex/custom-apexcharts.js') }}"></script> --}}

    <script>

       // MQTT Connection Configuration
       var mqttBroker = "{{ env('MQTT_HOST') }}";
        var mqttPort = 8884;
        var mqttTopicT = '{{ $device->device_id }}/sensor/dht22/t';
        var mqttTopicH = '{{ $device->device_id }}/sensor/dht22/h';
        var mqttUsername = "{{ env('MQTT_AUTH_USERNAME') }}";
        var mqttPassword = "{{ env('MQTT_AUTH_PASSWORD') }}";

        // Create a client instance
        var clientId = 'client_' + new Date().getTime();
        var client = new Paho.Client('wss://' + mqttBroker + ':' + mqttPort + '/mqtt', clientId);

        // Set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

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
        }

        // Callback function executed when the client loses its connection
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("Connection lost:", responseObject.errorMessage);
            }
        }

        // Callback function executed when a message arrives
        function onMessageArrived(message) {
            console.log("Message received:", message.payloadString);
            if (message.destinationName === mqttTopicT) {
                updateChart('chartT', message.payloadString);
            } else if (message.destinationName === mqttTopicH) {
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

        // Update chart with new data
        function updateChart(chartId, data) {
            var newData;
            try {
                newData = JSON.parse(data);
            } catch (e) {
                console.error("Failed to parse data:", data);
                return;
            }
            var timestamp = new Date().toISOString();

            if (chartId === 'chartT') {
                if (!Array.isArray(chartT.w.globals.series[0].data)) {
                    chartT.w.globals.series[0].data = [];
                }
                chartT.updateSeries([{
                    data: [...chartT.w.globals.series[0].data, newData],
                }], true);

                chartT.updateOptions({
                    xaxis: {
                        categories: [...chartT.w.globals.xaxis.categories, timestamp]
                    }
                }, true);
            } else if (chartId === 'chartH') {
                if (!Array.isArray(chartH.w.globals.series[0].data)) {
                    chartH.w.globals.series[0].data = [];
                }
                chartH.updateSeries([{
                    data: [...chartH.w.globals.series[0].data, newData],
                }], true);

                chartH.updateOptions({
                    xaxis: {
                        categories: [...chartH.w.globals.xaxis.categories, timestamp]
                    }
                }, true);
            }
        }

        // window.addEventListener("load", function(){

        //     getcorkThemeObject = localStorage.getItem("theme");
        //     getParseObject = JSON.parse(getcorkThemeObject)
        //     ParsedObject = getParseObject;

        //     if (ParsedObject.settings.layout.darkMode) {

        //         Apex.grid = {
        //             borderColor: '#191e3a'
        //         }
        //         Apex.track = {
        //             background: '#0e1726',
        //         }
        //         Apex.tooltip = {
        //             theme: 'dark'
        //         }


        //         // Simple Line Area

        //         var sLineArea ={
        //             series: [{
        //             name: 'Sales',
        //             data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
        //             }],
        //             chart: {
        //             height: 350,
        //             type: 'line',
        //             },
        //             forecastDataPoints: {
        //             count: 7
        //             },
        //             stroke: {
        //             width: 5,
        //             curve: 'smooth'
        //             },
        //             xaxis: {
        //             type: 'datetime',
        //             categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
        //             tickAmount: 10,
        //             labels: {
        //                 formatter: function(value, timestamp, opts) {
        //                 return opts.dateFormatter(new Date(timestamp), 'dd MMM')
        //                 }
        //             }
        //             },
        //             title: {
        //             text: 'Forecast',
        //             align: 'left',
        //             style: {
        //                 fontSize: "16px",
        //                 color: '#666'
        //             }
        //             },
        //             fill: {
        //             type: 'gradient',
        //             gradient: {
        //                 shade: 'dark',
        //                 gradientToColors: [ '#FDD835'],
        //                 shadeIntensity: 1,
        //                 type: 'horizontal',
        //                 opacityFrom: 1,
        //                 opacityTo: 1,
        //                 stops: [0, 100, 100, 100]
        //             },
        //             }
        //             };


        //     } else {

        //         Apex.grid = {
        //             borderColor: '#ebedf2'
        //         }
        //         Apex.track = {
        //             background: '#e0e6ed',
        //         }
        //         Apex.tooltip = {
        //             theme: 'dark'
        //         }


        //         // Simple Line Area

        //         var sLineArea = {
        //             series: [{
        //             name: 'Sales',
        //             data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
        //             }],
        //             chart: {
        //             height: 350,
        //             type: 'line',
        //             },
        //             forecastDataPoints: {
        //             count: 7
        //             },
        //             stroke: {
        //             width: 5,
        //             curve: 'smooth'
        //             },
        //             xaxis: {
        //             type: 'datetime',
        //             categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
        //             tickAmount: 10,
        //             labels: {
        //                 formatter: function(value, timestamp, opts) {
        //                 return opts.dateFormatter(new Date(timestamp), 'dd MMM')
        //                 }
        //             }
        //             },
        //             title: {
        //             text: 'Forecast',
        //             align: 'left',
        //             style: {
        //                 fontSize: "16px",
        //                 color: '#666'
        //             }
        //             },
        //             fill: {
        //             type: 'gradient',
        //             gradient: {
        //                 shade: 'dark',
        //                 gradientToColors: [ '#FDD835'],
        //                 shadeIntensity: 1,
        //                 type: 'horizontal',
        //                 opacityFrom: 1,
        //                 opacityTo: 1,
        //                 stops: [0, 100, 100, 100]
        //             },
        //             }
        //             };


        //     }


        //     // Simple Line Area

        //     var simpleLineArea = new ApexCharts(
        //         document.querySelector("#s-line-area"),
        //         sLineArea
        //     );

        //     simpleLineArea.render();




        //     /**
        //      * =================================================================================================
        //      * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |
        //      * =================================================================================================
        //      */

        //     document.querySelector('.theme-toggle').addEventListener('click', function() {

        //         getcorkThemeObject = localStorage.getItem("theme");
        //         getParseObject = JSON.parse(getcorkThemeObject)
        //         ParsedObject = getParseObject;

        //         // console.log(ParsedObject.settings.layout.darkMode)

        //         if (ParsedObject.settings.layout.darkMode) {

        //             simpleLineArea.updateOptions({
        //                 grid: {
        //                     borderColor: '#191e3a'
        //                 },
        //             })



        //         } else {
        //             // Apex.grid = {
        //             //     borderColor: '#ebedf2'
        //             // }
        //             // Apex.track = {
        //             //     background: '#e0e6ed',
        //             // }
        //             // Apex.tooltip = {
        //             //     theme: 'dark'
        //             // }

        //             simpleLineArea.updateOptions({
        //                 grid: {
        //                     borderColor: '#ebedf2'
        //                 },
        //             })



        //         }

        //     })

        // })


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

