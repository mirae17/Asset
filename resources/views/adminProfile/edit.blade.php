   
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
<div class="form-container" style="text-transform:uppercase;">
       <div class="row">
           <div class="col-lg-12 margin-tb">
               <div class="pull-left">
                   <h2>Edit User</h2>
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
     
       <form action="{{ route('adminProfile.update',$users->id) }}" method="POST">
           @csrf
           @method('PUT')
      
            <div class="row">
               <input type="hidden" name="id" value="{{ $users->id }}"> <br/>
   
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Name:</strong>
                       <input type="text" name="name" value="{{ old('name', $users->name) }}" class="form-control" placeholder="Name">
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Email:</strong>
                       <input type="email" class="form-control" name="email" value="{{ old('email', $users->email) }}" placeholder="Email"></input>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Phone Number:</strong>
                       <input type="text" class="form-control" name="part" value="{{ old('phone_number', $users->phone_number )}}" placeholder="Phone Number"></input>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Address:</strong>
                       <input type="text" class="form-control" name="address" value="{{ old('address',$users->address )}}" placeholder="Address"></input>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                   <div class="form-group">
                       <strong>Password:</strong>
                       <input type="password" class="form-control" name="part"  placeholder="Password"></input>
                   </div>
               </div>
               
               
              
               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                 <button type="submit" class="btn btn-primary">Submit</button>
                   <a class="btn btn-back"  href="{{ route('adminProfile.index') }}"> Back</a>
               </div>
           </div>
      
       </form>
       </div>
   @endsection