<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $verify->first_name }}</b>, <br/>
	<p>
		Thank you for creating a Vista Network account.
	</p>
	<p>
		Your Verification Code: <b>{{ $verify->code }}</b>
	</p>
	<p>
		You are receiving this email because you recently created an account or changed your email address.
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>