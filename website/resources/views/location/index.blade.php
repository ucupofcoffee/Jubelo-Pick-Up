@extends('layouts.app')

@section('content')
    <div class="pickup-container">
        <div class="row">
            <p id="status"></p>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th class="text-center th-location">Latitude</th>
                                <th class="text-center th-location">Longitude</th>
                                <th class="text-center th-location">Created</th>
                                <th class="text-center th-location">
                                    <div class="dropdown">
                                        <button class="btn-dots" type="button" id="actionDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                            <li>
                                                <a class="dropdown-item" onclick="startLocationTracking()">Start</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" onclick="stopLocationTracking()">Stop</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" onclick="clearStoredLocations()">Clear</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" onclick="saveStoredLocations()">Save</a>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="storedLocationsTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let locationInterval;
        let isTrackcingActive = false;

        function startLocationTracking() {
            getLocation();
            locationInterval = setInterval(getLocation, 1000);
            document.getElementById("status").innerHTML = "Location tracking started.";
            isTrackcingActive = true;
        }

        function stopLocationTracking() {
            clearInterval(locationInterval);
            document.getElementById("status").innerHTML = "Location tracking stopped.";
            isTrackcingActive = false;
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(storeLocation, handleLocationError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function handleLocationError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        function storeLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            let locations = JSON.parse(localStorage.getItem('locations')) || [];
            locations.push({
                latitude,
                longitude
            });
            localStorage.setItem('locations', JSON.stringify(locations));

            console.log(`Stored location: ${latitude}, ${longitude}`);
            displayStoredLocations();
        }

        function clearStoredLocations() {
            localStorage.removeItem('locations');
            document.getElementById("status").innerHTML = "Location tracking cleared.";
            displayStoredLocations();
        }

        function saveStoredLocations() {
            let locations = JSON.parse(localStorage.getItem('locations')) || [];
            if (locations.length === 0) {
                alert("No stored locations to send.");
                return;
            }

            locations.forEach((location, index) => {
                $.ajax({
                    url: "{{ route('location.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        latitude: location.latitude,
                        longitude: location.longitude
                    },
                    success: function(response) {
                        console.log(response.message);
                        localStorage.removeItem('locations');
                        document.getElementById("status").innerHTML = "Location tracking cleared.";
                        displayStoredLocations();
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred: " + error);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            console.error(xhr.responseJSON.errors);
                        }
                    }
                });
            });
        }


        function displayStoredLocations() {
            let locations = JSON.parse(localStorage.getItem('locations')) || [];
            let storedLocationsTableBody = document.getElementById('storedLocationsTableBody');
            storedLocationsTableBody.innerHTML = "";

            locations.forEach(location => {
                let row = document.createElement('tr');
                row.innerHTML = `
            <td class="text-center td-location">${location.latitude}</td>
            <td class="text-center td-location">${location.longitude}</td>
            <td class="text-center td-location">${location.created}</td>
            <td class="text-center td-location">${location.updated}</td>
        `;
                storedLocationsTableBody.appendChild(row);
            });
        }


        document.addEventListener("visibilitychange", function() {
            if (document.hidden) {} else {
                if (isTrackcingActive) {
                    startLocationTracking();
                }
            }
        });

        window.onload = function() {
            displayStoredLocations();
        };
    </script>
@endsection
