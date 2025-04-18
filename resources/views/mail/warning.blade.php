<!DOCTYPE html>
<html>
<head>
    <title>Rain Warning</title>
</head>
<body>
    <h2 style="color: {{ $color }};">Rain Warning: {{ ucfirst($color) }} Level</h2>
    <p>Current precipitation: <strong>{{ $precip }} mm</strong></p>

    <p>Please be cautious and take necessary actions based on the alert level.</p>

    <p>Stay safe,<br>
    Your Weather Monitoring Team</p>
</body>
</html>
