@extends('userFamily.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            @if (session('status'))
                <p>{{ session('status') }}</p>
            @else
                @if (auth()->user()->status == 'approved')
                    <!-- Button to Manage Family -->
                    <a href="{{ route('userFamily.table') }}" class="btn btn-success">Manage Family</a>
                @elseif (auth()->user()->status == 'rejected')
                    <p>Your request has been rejected.</p>
                    <!-- Button to Request Again -->
                    <form action="{{ route('userFamily.request') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info">Request Again</button>
                    </form>
                @elseif (auth()->user()->status == 'pending')
                    <p>Your request is pending approval.</p>
                @else
                    <!-- Button to Request to Manage Family -->
                    <form id="requestForm" action="{{ route('userFamily.request') }}" method="POST">
                        @csrf
                        <button type="submit" id="requestBtn" class="btn btn-primary">Request Family Members</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
