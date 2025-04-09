<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Asset Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .report-container {
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
        }
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-header h2 {
            margin: 0;
            color: #333;
            font-size: 36px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .report-header p {
            margin: 5px 0;
            color: #666;
            font-size: 18px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 16px;
            text-transform: uppercase;
        }
        th {
            background-color: #3490dc;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .highlight {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="report-header">
            <h2>Asset Report</h2>
            <p>Date: {{ $date }}</p>
            <p>Managed By: {{ $user->name }}</p>
            <p>Address: {{ $user->address }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Updated By</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Date Acquired</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentUserId = null;
                    $currentRowSpan = 1;
                @endphp

                @foreach ($assets as $index => $asset)
                    @php
                        $isNewUser = $asset->user_id !== $currentUserId;
                        $nextUserId = $assets[$index + 1]->user_id ?? null;
                        $currentRowSpan = $isNewUser ? $assets->where('user_id', $asset->user_id)->count() : $currentRowSpan;
                    @endphp

                    <tr>
                        @if ($isNewUser)
                            <td rowspan="{{ $currentRowSpan }}">{{ $asset->user->name }}</td>
                        @endif
                        <td>{{ $asset->type }}</td>
                        <td>{{ $asset->address }}  ({{ $asset->latitude }}, {{ $asset->longitude }})</td>
                        <td>{{ $asset->date }}</td>
                        <td>{{ number_format($asset->value, 2) }}</td>
                    </tr>

                    @php
                        $currentUserId = $nextUserId;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
