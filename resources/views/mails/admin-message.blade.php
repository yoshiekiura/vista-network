<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $admin->first_name }}</b>, <br/>
	<p>
		You have recieved a message from Vista Network administrator, the details are given below:<br/>
	</p>
	<p>
		<b>Subject:</b> {{ $admin->subject }} <br/>
		<b>Message:</b> {{ $admin->message }}
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>
