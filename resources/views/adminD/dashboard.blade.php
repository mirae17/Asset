@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Active Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="dashboard-card text-white">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="card-title">Active Users</div>
                        <div class="card-value">{{ $activeUsersCount }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="dashboard-card  text-white">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="card-title">Inactive Users</div>
                        <div class="card-value">{{ $inactiveUsersCount }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-user-slash"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Repeat similar structure for other cards -->
    </div>
</div>

@endsection

<style>
    .dashboard-card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }
    .card-value {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .card-icon {
        font-size: 3rem;
    }
    .text-white {
        color: #ffffff !important;
    }
</style>
