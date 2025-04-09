@extends('userAsset.template')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }

    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .alert {
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

    input.form-control {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .text-center {
        text-align: center;
    }

    button.btn {
        padding: 12px;
        box-sizing: border-box;
        border: none;
        border-radius: 5px;
        background-color: #3490dc;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button.btn:hover {
        background-color: #2779bd;
    }

    a.btn-back {
        display: inline-block;
        padding: 12px;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #3490dc;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    a.btn-back:hover {
        background-color: #5a6268;
    }
</style>

<div class="form-container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Asset</h2>
            </div>
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

    <form action="{{ route('userAsset.update', $asset->id) }}" method="POST" style="text-transform:uppercase;">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" name="id" value="{{ $asset->id }}"> <br/>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="text-transform: uppercase;">Type:</strong>
                    <select style="text-transform: uppercase;" id="type" class="form-control @error('type') is-invalid @enderror" name="type" onchange="toggleFields()">
                        <option value="">Select Type of Property</option>
                        <option value="LAND" {{ $asset->type == 'LAND' ? 'selected' : '' }}>Land</option>
                        <option value="BUILDING" {{ $asset->type == 'BUILDING' ? 'selected' : '' }}>Building</option>
                        <option value="HOUSE" {{ $asset->type == 'HOUSE' ? 'selected' : '' }}>House</option>
                        <!-- Add more options as needed -->
                    </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div id="address-group" class="col-xs-12 col-sm-12 col-md-12 form-group" style="{{ in_array($asset->type, ['LAND', 'BUILDING', 'HOUSE']) ? 'display:none;' : '' }}">
                <strong>Address:</strong>
                <input style="text-transform: uppercase;" type="text" class="form-control" name="address" value="{{ old('address', $asset->address) }}" placeholder="Address">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div id="coordinates-group" class="col-xs-12 col-sm-12 col-md-12" style="{{ !in_array($asset->type, ['LAND', 'BUILDING', 'HOUSE']) ? 'display:none;' : '' }}">
                <div class="form-group">
                    <strong>Longitude:</strong>
                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude', $asset->longitude) }}" placeholder="Longitude">
                    @error('longitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Latitude:</strong>
                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude', $asset->latitude) }}" placeholder="Latitude">
                    @error('latitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date Acquired:</strong>
                    <input type="date" class="form-control" name="date" value="{{ old('date', $asset->date) }}" placeholder="Date Acquired">
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Value:</strong>
                    <input type="number" class="form-control" name="value" value="{{ old('value', $asset->value) }}" placeholder="Value of Asset">
                    @error('value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-back" href="{{ route('userAsset.index') }}">Back</a>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleFields() {
        const type = document.getElementById('type').value;
        const addressGroup = document.getElementById('address-group');
        const coordinatesGroup = document.getElementById('coordinates-group');

        if (type === 'LAND' || type === 'BUILDING' || type === 'HOUSE') {
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
