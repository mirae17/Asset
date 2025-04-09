<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #3498db;
            margin: 0;
        }
        .content {
            margin-bottom: 30px;
        }
        .content p {
            margin: 10px 0;
        }
        .content ul {
            padding-left: 20px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Asset {{ ucfirst($action) }} Notification</h1>
        </div>
        <div class="content">
            <p>Dear Family Member,</p>
            <p>The following asset has been {{ $action }}:</p>
            <ul>
                <li><strong>Type:</strong> {{ strtoupper($asset->type) }}</li>
                <li><strong>Address:</strong> {{ strtoupper($asset->address) }}</li>
                <li><strong>Date:</strong> {{ $asset->date }}</li>
            </ul>
        </div>
        <div class="footer">
            <p>Regards,<br>Asset Management System</p>
        </div>
    </div>
</body>
</html>
