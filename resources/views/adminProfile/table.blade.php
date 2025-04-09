@section('content')
<style>
.text-uppercase {
    text-transform: uppercase;
}
</style>

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List of User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('user.create') }}"> Add New User</a>
            </div>
        </div>
    </div>
   <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered" style="text-transform:uppercase;">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Joined On</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->phone_number }}</td>
            <td>{{ $u->address }}</td>
            <td>{{ $u->created_at }}</td>
            <td>
                <form action="{{ route('adminProfile.destroy',$u->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('adminProfile.show',$u->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('adminProfile.edit',$u->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection