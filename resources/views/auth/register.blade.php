@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for registration page -->
    
</head>

<body style="background-color:#47342c;">

    <div class="container register-container" >

        <div class="card o-hidden border-0 shadow-lg my-5 register-box">
            <div class="card-body p-0" >
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="user" style="text-transform:uppercase;">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="phone_number" type="tel" class="form-control form-control-user @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" placeholder="Phone Number">
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="Address">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" placeholder="User Type">
                                    <select id="userType" class="form-select form-control form-control-user @error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" placeholder="User Type">
                                    <option class="form-select form-control form-control-user" value="" selected disabled>Select User Type</option>
                                        <option class="form-select form-control form-control-user" value="user">User</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" id="password-confirm" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block" style="background-color:coral;border-color:coral;">
                                    {{ __('Register') }}
                                </button>
                                <hr>
                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
@endsection
