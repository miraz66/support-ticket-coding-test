<!DOCTYPE html>
<html>

<head>
    <title>This Ticket Has Been Closed</title>
</head>

<body>
    <h1>Ticket Closed: {{ $ticket->subject }}</h1>
    <p>There is a new reply to your support ticket:</p>
    <p>{{ $ticket->replies->last()->message }}</p>
    <p>Thank you for contacting support!</p>
</body>

</html>
