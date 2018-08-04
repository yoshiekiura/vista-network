<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>Vibetron</b>, <br/>
	<p>
		You have recieved a message from Vista Network website contact us page, the details are given below:<br/>
	</p>
	<p>
		<b>Name:</b> {{ $contact->name }} <br/>
		<b>Email:</b> {{ $contact->email }} <br/>
		<b>Phone:</b> {{ $contact->phone }} <br/>
		<b>Subject:</b> {{ $contact->subject }} <br/>
		<b>Message:</b> {{ $contact->message }}
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>
