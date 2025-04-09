

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
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>List of Assets</h2>
                <a class="btn btn-success" href="{{ route('userAsset.create') }}">Add New Asset</a>
            </div>
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
                <th>Type</th>
                <th>Address</th>
                <th>Date Acquired</th>
                <th>Value</th>
                <th>Joined On</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $a)
            <tr>
                <td class="text-uppercase">{{ $a->id }}</td>
                <td class="text-uppercase">{{ $a->type }}</td>
                <td class="text-uppercase">
                    {{ $a->address }}
                    @if (strtolower($a->type) == 'land')
                        Coordinates: ({{ $a->latitude }}, {{ $a->longitude }})
                    @endif
                </td>
                <td class="text-uppercase">{{ $a->date }}</td>
                <td class="text-uppercase">{{ $a->value }}</td>
                <td class="text-uppercase">{{ $a->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('userAsset.destroy', $a->id) }}" method="POST" class="d-flex justify-content-center">
                        <a class="btn btn-info" href="{{ route('userAsset.show', $a->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('userAsset.edit', $a->id) }}">Edit</a>
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
