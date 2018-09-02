<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $withdraw->first_name }}</b>, <br/>
	<p>
		Your request for withdraw refunds have successfully completed!<br/>
	</p>
	<p>
		<b>Transaction Details</b><br/><br/>
		Payment Gateway: <b>{{ $withdraw->method }}</b><br/>
		Amount: <b>${{ $withdraw->amount }}</b><br/>
		Charges: <b>${{ $withdraw->charge }}</b><br/>
		Transaction ID: <b>{{ $withdraw->trans_id }}</b><br/>
	</p>	
	<p>
		<i>{{ $withdraw->message }}</i>
	</p>
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>
