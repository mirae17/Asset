@extends('accountDeactived.template')

@section('content')

<style>
.text-uppercase {
    text-transform: uppercase;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Deactivated Users</h2>
            <table class="table table-bordered" style="text-transform:uppercase;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
