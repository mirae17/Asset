@extends('adminProfile.template')
<!-- resources/views/profile.blade.php -->



@section('content')
<style>
    .container {
        margin-top: 10px;
    }

    .card {
        border-radius: 15px;
    }

    .card-body {
        padding: 30px;
    }

    .form-control-file {
        display: block;
        margin-top: 10px;
    }

    .btn-primary {
        background-color: #3490dc;
        border-color: #3490dc;
    }

    .btn-primary:hover {
        background-color: #2779bd;
        border-color: #2779bd;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control, .form-control-file, .custom-file-input {
        margin-top: 5px;
        margin-bottom: 20px;
    }

    .nav-link.active {
        font-weight: bold;
        color: #3490dc;
    }

    .rounded-circle {
        border: 2px solid #3490dc;
    }

    .avatar-upload img {
        border: 2px solid #3490dc;
        margin-bottom: 10px;
    }

    .avatar-upload .btn-secondary,
    .avatar-upload .btn-danger {
        margin-top: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">General Settings</h5>
                    <br>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Profile configuration settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">General Settings</h5>
                    <br>
                    <form action="{{ route('adminProfile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <div class="avatar-upload">
                                    <img src="{{ auth()->user()->avatar }}" alt="avatar" class="rounded-circle" width="100" height="100">
                                    <div class="mt-3">
                                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ auth()->user()->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone_number }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_line_2" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address_line_2" name="address" value="{{ auth()->user()->address }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="current_password" class="col-sm-2 col-form-label">Current password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-sm-2 col-form-label">New password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_new_password" class="col-sm-2 col-form-label">Confirm new password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm new password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <small class="form-text text-muted">
                                    Password requirements:<br>
                                    Ensure that these requirements are met:<br>
                                    • Minimum 8 characters long the more, the better<br>
                                    • At least one lowercase character<br>
                                    • At least one uppercase character<br>
                                    • At least one number, symbol, or whitespace character<br>
                                </small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
           
    </div>
</div>
@endsection
