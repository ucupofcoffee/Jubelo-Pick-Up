@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow p-1">
                    <div class="row my-4 d-flex justify-content-between">
                        <div class="col-6 px-5">
                            <a href="{{ route('history.index') }}"><i class="ni ni-bold-left text-blue fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col mt-4" style="width: 100%; display: flex;">
                        <div style="width: 100%;">
                            @if ($pickup1->isNotEmpty())
                                @foreach ($pickup1 as $pickup)
                                    <h1>{{ $pickup->name }}</h1>
                                    <h5>#{{ $pickup->transaction_id }}</h5>
                                    <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}</h5>
                                    <div style="display: flex; gap: 10px;">
                                        <h5><i class="ni ni-mobile-button text-blue"></i> {{ $pickup->phone }}</h5>
                                        <h5><i class="ni ni-email-83 text-blue"></i> {{ $pickup->email }}</h5>
                                    </div>
                                    <h5><i class="ni ni-basket text-blue"></i>
                                        {{ $pickup->type ? $pickup->type->name : '- ' }}</h5>
                                    <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}</h5>
                                @endforeach
                            @endif
                            <div class="dropdown-divider"></div>
                            @if ($pickup2->isNotEmpty())
                                @foreach ($pickup2 as $pickup)
                                    <h1>{{ $pickup->name }}</h1>
                                    <h5>#{{ $pickup->transaction_id }}</h5>
                                    <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}</h5>
                                    <div style="display: flex; gap: 10px;">
                                        <h5><i class="ni ni-mobile-button text-blue"></i> {{ $pickup->phone }}</h5>
                                        <h5><i class="ni ni-email-83 text-blue"></i> {{ $pickup->email }}</h5>
                                    </div>
                                    <h5><i class="ni ni-basket text-blue"></i>
                                        {{ $pickup->type ? $pickup->type->name : '- ' }}</h5>
                                    <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}</h5>
                                @endforeach
                            @endif
                            <div class="dropdown-divider"></div>
                            @if ($pickup3->isNotEmpty())
                                @foreach ($pickup3 as $pickup)
                                    <h1>{{ $pickup->name }}</h1>
                                    <h5>#{{ $pickup->transaction_id }}</h5>
                                    <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}</h5>
                                    <div style="display: flex; gap: 10px;">
                                        <h5><i class="ni ni-mobile-button text-blue"></i> {{ $pickup->phone }}</h5>
                                        <h5><i class="ni ni-email-83 text-blue"></i> {{ $pickup->email }}</h5>
                                    </div>
                                    <h5><i class="ni ni-basket text-blue"></i>
                                        {{ $pickup->type ? $pickup->type->name : '- ' }}</h5>
                                    <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}</h5>
                                @endforeach
                            @endif
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([-6.2088, 106.8456], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var pathCoordinates = [
            [-6.2088, 106.8456],
            [-6.1754, 106.8272],
            [-6.1932, 106.8490],
            [-6.2325, 106.8265]
        ];

        var polyline = L.polyline(pathCoordinates, {
            color: 'red'
        }).addTo(map);
        map.fitBounds(polyline.getBounds());
    </script>

@endsection
