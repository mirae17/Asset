@extends('faraid.template')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faraid Inheritance Distribution</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
        .container {
            margin-top: 20px;
        }
        h1, h2 {
            font-weight: bold;
            text-transform: uppercase;
        }
        .card {
            margin-top: 20px;
            border: none;
        }
        .card-body {
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .alert {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .sort-btn {
            cursor: pointer;
            display: inline-block;
            margin-left: 5px;
            color: #007bff;
        }
        .sort-btn:hover {
       
            background-color: #e7e7e7;
        }
        .sort-icon {
            font-size: 0.8em;
        }
    </style>
     <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("inheritanceTable");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Faraid Inheritance Distribution</h1>

                <div class="mt-4">
                    <h2>Total Asset Value: {{ number_format($assets->sum('value'), 2) }}</h2>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table id="inheritanceTable" class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Family Member
                                <span class="sort-btn" onclick="sortTable(0)">&#9650;&#9660;</span>
                            </th>
                            <th>Relation</th>
                            <th>Share (%)</th>
                            <th>Share Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shares as $share)
                        <tr>
                            <td class="text-uppercase">{{ $share['name'] }}</td>
                            <td class="text-uppercase">{{ $share['relation'] }}</td>
                            <td class="text-uppercase">{{ number_format(($share['share'] / $assets->sum('value')) * 100, 2) }}%</td>
                            <td class="text-uppercase">{{ number_format($share['share'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
