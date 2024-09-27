<!DOCTYPE html>
<html>

<head>
    <title>New Ticked Posted</title>
</head>

<body>
    <h1>Reply to Your Ticket: {{ $ticket->subject }}</h1>
    <p>There is a new reply to your support ticket:</p>
    <p>{{ $ticket->description }}</p>
    <a href="{{ url('/admin/' . $ticket->id) }}">View Customer Ticket</a>
</body>

</html>
