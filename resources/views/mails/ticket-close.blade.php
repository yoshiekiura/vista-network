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
		This support request has been marked as completed and ticket status is now set to <b>close</b>.
	</p>
	<p>
		You can view the ticket at any time for this please login using following url <a href="http://beta.vista.network/login" target="_blank">Login</a>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>