@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <script src="https://www.googleapis.com/maps/api/js?key=AIzaSyCyVSNnBSC2inE88KAJEuFNWbtlSyvSbTg&callback=initMap"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(-6.92222000, 107.60694000),
                zoom:11
            });

            var initialMarker = {
                lat: -6.92222000,
                lng: 107.60694000
            };
            
            var initialMarkerIcon = {
                url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            };
            
            addMarker(initialMarker, map, 'Initial Location', initialMarkerIcon);

            var locations = @json($locations);

            locations.forEach(function(location, index) {
                var marker = {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude)
                };
                addMarker(marker, map, 'Location ' + (index + 1));
            });

            var firstLocation = {
                lat: parseFloat(locations[0].latitude),
                lng: parseFloat(locations[0].longitude)
            };
            var secondLocation = {
                lat: parseFloat(locations[1].latitude),
                lng: parseFloat(locations[1].longitude)
            };
            var thirdLocation = {
                lat: parseFloat(locations[2].latitude),
                lng: parseFloat(locations[2].longitude)
            };

            drawRoute(initialMarker, firstLocation, map);
            drawRoute(firstLocation, secondLocation, map);
            drawRoute(firstLocation, thirdLocation, map);
        }

        function addMarker(marker, map, title = '', icon = null) {
            new google.maps.Marker({
                position: marker,
                map: map,
                title: title,
                icon: icon
            });
        }

        function drawRoute(origin, destination, map) {
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            var request = {
                origin: new google.maps.LatLng(origin.lat, origin.lng),
                destination: new google.maps.LatLng(destination.lat, destination.lng),
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
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
@endsection
