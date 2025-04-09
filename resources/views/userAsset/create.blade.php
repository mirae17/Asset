@extends('userAsset.template')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    h2 {
        text-align: center;
        color: #3490dc;
        margin-bottom: 20px;
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

    .btn-back-container {
        margin-top: 30px;
        text-align: center;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 20px; /* Adjust padding as needed */
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        width: auto; /* Ensure button width adjusts based on content */
    }

    .btn-back:hover {
        background-color: #495057;
    }
</style>

<div class="form-container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Add New Asset</h2>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('userAsset.store') }}" method="POST" style="text-transform:uppercase;">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" onchange="toggleFields()">
                        <option value="">Select Type of Property</option>
                        <option value="land">Land</option>
                        <option value="building">Building</option>
                        <option value="house">House</option>
                        <!-- Add more options as needed -->
                    </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

           

            <div id="coordinates-group" class="col-md-12">
                
                <div class="form-group">
                    <strong>Latitude:</strong>
                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                           placeholder="Latitude" value="{{ old('latitude') }}">
                    @error('latitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Longitude:</strong>
                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                           placeholder="Longitude" value="{{ old('longitude') }}">
                    @error('longitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Date Acquired:</strong>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                           placeholder="Date Acquired" value="{{ old('date') }}">
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Value:</strong>
                    <input type="number" class="form-control @error('value') is-invalid @enderror" name="value"
                           placeholder="Value of Asset" value="{{ old('value') }}">
                    @error('value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 text-center btn-back-container">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-back " href="{{ route('userAsset.index') }}">Back</a>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleFields() {
        const type = document.getElementById('type').value;
        const addressGroup = document.getElementById('address-group');
        const coordinatesGroup = document.getElementById('coordinates-group');

        if (type === 'land' || type === 'building' || type === 'house') {
            addressGroup.style.display = 'none';
            coordinatesGroup.style.display = 'block';
        } else {
            addressGroup.style.display = 'block';
            coordinatesGroup.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleFields();
    });
</script>
@endsection
