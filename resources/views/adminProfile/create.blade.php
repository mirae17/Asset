@extends('adminProfile.template')
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
            <h2>Add New User</h2>
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


    <form action="{{ route('user.store') }}"  style="text-transform:uppercase;" method="POST">
        @csrf

        <div class="row" >
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="text" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-12">
                <div class="form-group">
                    <strong> Confirm password:</strong>
                    <input type="text" class="form-control" name="password" placeholder=" Confirm Password">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-back" href="{{ route('user.index') }}"> Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
