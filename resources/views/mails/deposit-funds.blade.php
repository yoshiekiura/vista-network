<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $deposit->first_name }}</b>, <br/>
	<p>
		Congratulations! Your payment was processed successfully.<br/><br/>
		Payment Gateway: <b>{ $deposit->gateway }}</b>
		Funds Deposit: <b>{{ $deposit->amount }}{{ $deposit->symbol }}</b><br/>
		Current Balance: <b>{{ $deposit->balance }}</b>
	</p>
	<p>
		If you do not initiate this change, please contact your administrator immediately.
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>