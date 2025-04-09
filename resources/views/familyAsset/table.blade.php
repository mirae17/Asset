@section('content')
<div class="container">
    <h2>List of Family Members</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>FAMILY MEMBER</th>
                <th>RELATION</th>
                <th>SHARE (%)</th>
                <th>SHARE AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @if ($assets->sum('value') > 0)
                @foreach ($shares as $share)
                    <tr>
                        <td class="text-uppercase">{{ $share['name'] }}</td>
                        <td class="text-uppercase">{{ $share['relation'] }}</td>
                        <td class="text-uppercase">{{ number_format(($share['share'] / $assets->sum('value')) * 100, 2) }}%</td>
                        <td class="text-uppercase">{{ number_format($share['share'], 2) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No assets/family available to calculate shares.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
