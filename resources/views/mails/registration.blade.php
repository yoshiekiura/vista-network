<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $register->first_name }}&nbsp;{{ $register->last_name }}</b>, <br/>
	<p>
		Our warmest congratulations on your new account opening! This only shows that you have grown your business well. I pray for your prosperous.
	</p>
	<p>
		You have taken this path knowing that you can do it. Good luck with your new business. I wish you all the success and fulfillment towards your goal.
	</p>
	<p>
		Your Username: <b>{{ $register->username }}</b><br/>
		Your Password: <b>{{ $register->password }}</b>
	</p>	
	<p>
		Remember, never share your password with others. And you are agree with our Terms and Policy.
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>