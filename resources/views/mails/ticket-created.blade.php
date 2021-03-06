<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $ticket->first_name }}</b>, <br/>
	<p>
		Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email. The details of your ticket are shown below..<br/><br/>
		Ticket ID: <b>{{ $ticket->ticket_id }}</b><br/>
		Subject: <b>{{ $ticket->subject }}</b><br/>
		Status: <b>{{ $ticket->status }}</b>
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