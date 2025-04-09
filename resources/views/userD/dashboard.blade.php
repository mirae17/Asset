<!-- resources/views/userD/dashboard.blade.php -->

@extends('userD.template')

@section('content')
<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    .card {
        border-radius: 15px;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card .fa-2x {
        font-size: 2.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 2rem;
    }
</style>

<div class="container">
    <h1 class="my-4">Dashboard</h1>
    <div class="row">
        <!-- Total Assets Card -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-coins fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title fw-bold">Total Assets</h5>
                            <p class="card-text display-6 fw-bold">{{ $assetCount }}</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Total Family Members Card -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title fw-bold">Total Family Members</h5>
                            <p class="card-text display-6 fw-bold">{{ $familyCount }}</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Add more cards or content here if needed -->
    </div>
</div>
@endsection
