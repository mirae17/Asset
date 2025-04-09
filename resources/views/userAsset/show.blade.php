@extends('userAsset.template')

@section('content')
<style>
    .details-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group strong {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #3490dc;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .pull-right {
        text-align: right;
    }

    .btn-back {
        margin-top: 10px;
    }

    #map {
        height: 400px;
        width: 100%;
    }

    .text-uppercase {
        text-transform: uppercase;
    }
</style>

<div class="details-container" style="text-transform:uppercase;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Asset Details</h2>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type:</strong>
                {{ $asset->type }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $asset->address }}
            </div>
        </div>
        @if (strtolower($asset->type) == 'land')
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Coordinates:</strong>
                ({{ $asset->latitude }}, {{ $asset->longitude }})
            </div>
        </div>
        @endif
        <div id="map"></div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date Acquired:</strong>
                {{ $asset->date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Value:</strong>
                {{ $asset->value }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Joined On:</strong>
                {{ $asset->created_at }}
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('userAsset.index') }}"> Back</a>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApR0l8Jwpbwmk9gZmadLYOirF0ju2HG6g&callback=initMap" async defer></script>
<script>
    function initMap() {
        var latitude = parseFloat("{{ $asset->latitude }}");
        var longitude = parseFloat("{{ $asset->longitude }}");
        var address = "{{ $asset->address }}";
        var type = "{{ strtolower($asset->type) }}";
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: { lat: latitude, lng: longitude }
        });

        var marker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: map,
            title: address
        });

        var contentString = `<strong>Address:</strong> ${address}<br>`;
        if (type === 'land') {
            contentString += `<strong>Coordinates:</strong> (${latitude}, ${longitude})`;
        }

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
</script>
@endsection
