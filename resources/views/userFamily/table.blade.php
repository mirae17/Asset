@extends('userFamily.template')
@section('content')

<style>
.text-uppercase {
    text-transform: uppercase;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
}
.table th {
    background-color: #f8f9fa;
    font-weight: bold;
}
.table tbody tr:hover {
    background-color: #f1f1f1;
}
.table .btn {
    margin: 0 5px;
}
.alert-success {
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
}
.table .btn {
    font-size: 0.9rem;
}
</style>

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h2>List of Family Members</h2>
            <a class="btn btn-success" href="{{ route('userFamily.create') }}">Add New Family</a>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Relation</th>
                <th>Joined On</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($family as $f)
            <tr>
                <td class="text-uppercase">{{ $f->id }}</td>
                <td class="text-uppercase">{{ $f->name }}</td>
                <td class="text-uppercase">{{ $f->email }}</td>
                <td class="text-uppercase">{{ $f->phone_number }}</td>
                <td class="text-uppercase">{{ $f->address }}</td>
                <td class="text-uppercase">{{ $f->relation }}</td>
                <td class="text-uppercase">{{ $f->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('userFamily.destroy', $f->id) }}" method="POST" class="d-flex justify-content-center">
                        <a class="btn btn-info" href="{{ route('userFamily.show', $f->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('userFamily.edit', $f->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
