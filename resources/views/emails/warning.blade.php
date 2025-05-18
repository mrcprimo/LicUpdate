<!DOCTYPE html>
<html>
<head>
    <title>Rain Warning</title>
</head>
<body>
    <h2 style="color: {{ $color }};">Rain Warning: {{ ucfirst($color) }} Level</h2>
    <p>Current precipitation: <strong>{{ $precip }} mm</strong></p>

    <p>Please be cautious and take necessary actions based on the alert level.</p>

    @if($color === 'yellow')
        <ul>
            <li>Carry an umbrella when going out.</li>
            <li>Avoid outdoor activities if unnecessary.</li>
            <li>Monitor weather updates regularly.</li>
        </ul>
    @elseif($color === 'orange')
        <ul>
            <li>Postpone travel plans if possible.</li>
            <li>Ensure proper drainage around your home.</li>
            <li>Stay updated with official weather bulletins.</li>
        </ul>
    @elseif($color === 'red')
        <ul>
            <li>Stay indoors unless absolutely necessary.</li>
            <li>Prepare emergency supplies (food, water, flashlight, etc.).</li>
            <li>Evacuate if instructed by local authorities.</li>
        </ul>
    @else
        <p>No specific actions available for this alert level.</p>
    @endif

    <p>Stay safe,<br>
    Your Weather Monitoring Team</p>
</body>
</html>
