<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $deposit->first_name }}</b>, <br/>
	<p>
		You have successfully transfered funds from your {{ $deposit->gateway }} account to Vista Network account.
	</p>
	<p>
		The following transaction has been debited from your account.<br/>
		<b>Transaction Details</b><br/><br/>
		Payment Gateway: <b>{{ $deposit->gateway }}</b><br/>
		Amount: <b>${{ $deposit->amount }}</b><br/>
		Transaction ID: <b>{{ $deposit->trans_id }}</b><br/>
		Date: <b>{{ $deposit->date }}</b>
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