
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Users</h2>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($users->count() > 0)
    <table class="table table-bordered" style="text-transform:uppercase;">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Joined On</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone_number }}</td>
                    <td>{{ $u->address }}</td>
                    <td>{{ $u->created_at }}</td>
                    <td> 
                        @if ($u->status == 'pending')
                            <span class="badge badge-warning">{{ ucfirst($u->status) }}</span>
                        @elseif ($u->status == 'approved')
                            <span class="badge badge-success">{{ ucfirst($u->status) }}</span>
                        @elseif ($u->status == 'deactivated')
                            <span class="badge badge-secondary">{{ ucfirst($u->status) }}</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($u->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($u->status == 'pending')
                            <form action="{{ route('userApproval.approve',  $u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>

                            <form action="{{ route('userApproval.reject', $u->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        @elseif ($u->status == 'approved')
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deactivateModal{{ $u->id }}">Deactivate</button>
                            
                            <!-- Deactivate Modal -->
                            <div class="modal fade" id="deactivateModal{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel{{ $u->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deactivateModalLabel{{ $u->id }}">Deactivate User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('userApproval.deactivate', $u->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="comment">Comment</label>
                                                    <textarea name="comment" id="comment" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Deactivate</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @elseif ($u->status == 'deactivated')
                           
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No user requests</p>
@endif

@endsection
