<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $password->first_name }}</b>, <br/>
	<h3>Can't remember your password?</h3>
	<p>
		Dont't worry about it. It happens. We can help.<br/>
		<b>Your email address is:</b> {{ $password->email }}
	</p>
	<p>
		Use This Link to Reset Password: {{ url('/') . '/reset/' . $password->code }};
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>