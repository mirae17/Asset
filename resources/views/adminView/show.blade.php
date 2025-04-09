@extends('adminView.template')
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


</style>

<div class="details-container" style="text-transform:uppercase;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Admin Details</h2>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $admin->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $admin->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone Number:</strong>
                {{ $admin->phone_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $admin->address }}
            </div>
        </div>
        <div id="map"></div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <strong>Joined On:</strong>
                {{ $admin->created_at }}
            </div>
        </div>
        <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('adminView.index') }}"> Back</a>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApR0l8Jwpbwmk9gZmadLYOirF0ju2HG6g&callback=initMap" async defer></script>
<script>
    function initMap() {
        var address = "{{ $admin->address }}";
        var geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -34.397, lng: 150.644}
        });

        geocodeAddress(geocoder, map, address);
    }

    function geocodeAddress(geocoder, map, address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
@endsection