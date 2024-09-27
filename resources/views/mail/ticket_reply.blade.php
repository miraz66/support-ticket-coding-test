<!DOCTYPE html>
<html>

<head>
    <title>New Reply to Your Ticket</title>
</head>

<body>
    <h1>Reply to Your Ticket: {{ $ticket->subject }}</h1>
    <p>There is a new reply to your support ticket:</p>
    <p>{{ $ticket->replies->last()->message }}</p>
    <p>Thank you for contacting support!</p>
</body>

</html>
