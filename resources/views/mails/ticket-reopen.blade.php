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
		You can view the ticket at any time at http://beta.vista.network/support/reply/{{ $ticket->ticket_id }}
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>