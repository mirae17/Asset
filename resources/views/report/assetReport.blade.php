@extends('report.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .report-container {
            width: 90%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-header h2 {
            margin: 0;
            color: #333;
            font-size: 36px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .report-header p {
            margin: 5px 0;
            color: #666;
            font-size: 18px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 16px;
            text-transform: uppercase;
        }
        th {
            background-color: #3490dc;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .map-container {
            margin-top: 30px;
            width: 100%;
            height: 500px;
        }
        .highlight {
            font-weight: bold;
            color: #d9534f;
        }
        .clickable {
            cursor: pointer;
            color: #007bff;
        }
        .clickable:hover {
            text-decoration: underline;
        }
        .download-pdf-btn {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px 20px;
        border-radius: 10px;
        background: linear-gradient(45deg, #3490dc, #6574cd);
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .download-pdf-btn:hover {
        background: linear-gradient(45deg, #6574cd, #3490dc);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .download-pdf-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.5);
    }
    </style>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApR0l8Jwpbwmk9gZmadLYOirF0ju2HG6g"></script>
<script>
    var geocodedLocations = {};

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 0, lng: 0} // Default center, will adjust based on geocoded locations
        });

        var geocoder = new google.maps.Geocoder();
        var bounds = new google.maps.LatLngBounds();

        @foreach ($assets as $asset)
            @if ($asset->latitude && $asset->longitude)
                var latLng = new google.maps.LatLng({{ $asset->latitude }}, {{ $asset->longitude }});
                addMarker(map, latLng, "{{ $asset->address }}", bounds);
            @else
                geocodeAddress(geocoder, map, "{{ $asset->address }}", bounds);
            @endif
        @endforeach
    }

    function geocodeAddress(geocoder, map, address, bounds) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                var location = results[0].geometry.location;
                geocodedLocations[address] = location;

                addMarker(map, location, address, bounds);
            } else {
                console.error('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    function addMarker(map, location, address, bounds) {
        var marker = new google.maps.Marker({
            map: map,
            position: location
        });
        bounds.extend(location);
        map.fitBounds(bounds);
    }

    function focusOnAddress(address) {
        var location = geocodedLocations[address];
        if (location) {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });

            new google.maps.Marker({
                map: map,
                position: location
            });
        } else {
            console.error('Location not found for address: ' + address);
        }
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.address-cell').forEach(cell => {
            cell.addEventListener('click', () => {
                focusOnAddress(cell.textContent.trim());
            });
        });
    });
</script>

</head>
<body onload="initMap()">
    <div class="report-container">
        <div class="report-header">
            <h2>Asset Report</h2>
            <p>Date: {{ $date }}</p>
            <p>Managed By: {{ $user->name }}</p>
            <p>Address: {{ $user->address }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Updated By</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Date Acquired</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentUserId = null;
                    $currentRowSpan = 1;
                @endphp

                @foreach ($assets as $index => $asset)
                    @php
                        $isNewUser = $asset->user_id !== $currentUserId;
                        $nextUserId = $assets[$index + 1]->user_id ?? null;
                        $currentRowSpan = $isNewUser ? $assets->where('user_id', $asset->user_id)->count() : $currentRowSpan;
                    @endphp

                    <tr>
                        @if ($isNewUser)
                            <td rowspan="{{ $currentRowSpan }}">{{ $asset->user->name }}</td>
                        @endif
                        <td>{{ $asset->type }}</td>
                        <td class="address-cell clickable">
                            {{ $asset->address }}
                           
                                {{ $asset->latitude }}, {{ $asset->longitude }}
                           
                        </td>
                        <td>{{ $asset->date }}</td>
                        <td>{{ number_format($asset->value, 2) }}</td>
                    </tr>

                    @php
                        $currentUserId = $nextUserId;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div id="map" class="map-container"></div>
        <br>
       <div class="d-flex justify-content-center">
       <a href="{{ route('report.downloadPDF') }}" class="btn btn-primary">Download PDF</a>
    </div>
    </div>
   
</body>
</html>
@endsection
