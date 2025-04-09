   
@extends('userFamily.template')
   
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
<div class="form-container" >
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
     
       <form action="{{ route('userFamily.update',$family->id) }}" method="POST" >
           @csrf
           @method('PUT')
      
            <div class="row" >
               <input type="hidden" name="id" value="{{ $family->id }}"> <br/>
               <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input style="text-transform:uppercase;" type="text" class="form-control" name="name" value="{{ old('name', $family->name) }}" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input  type="text" class="form-control" name="email" value="{{ old('email', $family->email) }}" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    <input style="text-transform:uppercase;" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $family->phone_number) }}" placeholder="Phone Number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <input style="text-transform:uppercase;" type="text" class="form-control" name="address" value="{{ old('address', $family->address) }}" placeholder="Address">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group" style="text-transform:uppercase;">
                    <strong >Relation:</strong>
                    <select style="text-transform:uppercase;" id="relation" class="form-control @error('relation') is-invalid @enderror" name="relation" value="{{ old('relation', $family->relation) }}">
                                    <option value="">Select Relation</option>
                                    <option value="husband">Husband</option>
                                    <option value="wife">Wife</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="brother">Brother</option>
                                    <option value="sister">Sister</option>
                                    <option value="son">Son</option>
                                    <option value="daughter">Daughter</option>
                                    <option value="step_daughter">Step daugther</option>
                                    <option value="step_son">Step son</option>
                                    <option value="grandson">GrandSon</option>
       
                                    <!-- Add more options as needed -->
                     </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
              
               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                 <button type="submit" class="btn btn-primary">Submit</button>
                   <a class="btn btn-back"  href="{{ route('userFamily.table') }}"> Back</a>
               </div>
           </div>
      
       </form>
       </div>
   @endsection