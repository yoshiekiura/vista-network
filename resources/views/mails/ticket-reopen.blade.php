<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $ticket->first_name }}</b>, <br/>
	<p>
		Ticket ID: <b>{{ $ticket->ticket_id }}</b><br/>
		Status: <b>{{ $ticket->status }}</b>
	</p>	
	<p>
		This support request has <b>Reopen</b> your ticket.
	</p>
	<p>
		You can view the ticket at any time for this please login using following url <a href="https://vista.network/login" target="_blank">Login</a>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>