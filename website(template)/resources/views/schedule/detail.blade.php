@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow p-1">
                    <div class="row my-4 d-flex justify-content-between">
                        <div class="col-6 px-5">
                            <a href="{{ route('schedule.index') }}"><i class="ni ni-bold-left text-blue fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col mt-4" style="width: 100%; display: flex;">
                        <div style="width: 100%;">
                            <h1>{{ $schedule->name }}</h1>
                            <h5>#{{ $schedule->transaction_id }}</h5>
                            <h5><i class="ni ni-square-pin text-blue"></i> {{ $schedule->full_address }}</h5>
                            <div style="display: flex; gap: 10px;">
                                <h5><i class="ni ni-mobile-button text-blue"></i> {{ $schedule->phone }}</h5>
                                <h5><i class="ni ni-email-83 text-blue"></i> {{ $schedule->email }}</h5>
                            </div>
                            <h5><i class="ni ni-basket text-blue"></i>
                                {{ $schedule->type ? $schedule->type->name : '- ' }}</h5>
                            <h5><i class="ni ni-time-alarm text-blue"></i> {{ $schedule->pick_up_time }}</h5>
                        </div>
                    </div>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var latitude = {{ $schedule->latitude }};
        var longitude = {{ $schedule->longitude }};

        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('{{ $schedule->name }}<br>{{ $schedule->transaction_id }}<br>{{ $schedule->g_maps_address }}')
            .openPopup();
    </script>
@endsection
