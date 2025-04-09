@extends('layouts.userTemplate')

<!-- resources/views/userD/dashboard.blade.php -->

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Assets</h5>
                    <p class="card-text">{{ $assetCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Family Members</h5>
                    <p class="card-text">{{ $familyCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

