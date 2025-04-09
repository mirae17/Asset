@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Active Users</div>

                <div class="card-body">
                    <h1>{{ $activeUsersCount }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Inactive Users</div>

                <div class="card-body">
                    <h1>{{ $inactiveUsersCount }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
