<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $funds->first_name }}</b>, <br/>
	<p>
		Your request to transfer funds (${{ $funds->amount }}) to <b>{{ $funds->receiver_username }}</b> have been canceled due to some technical reasons. Please try again some later time. 
	</p>	
	<p>
		If you do not initiate this transaction, please contact your administrator immediately.
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>