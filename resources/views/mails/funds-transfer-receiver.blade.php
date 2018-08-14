<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $rfunds->receiver_first_name }}</b>, <br/>
	<p>
		You have received funds from <b>({{ $rfunds->giver_username }})</b>. Funds are successfully added to your account.
	</p>
	<p>
		The following are the transaction details.<br/>
		<b>Transaction Details</b><br/>

		Transaction ID: <b>{{ $rfunds->receiver_trans_id }}</b><br/>
		Amount: <b>${{ $rfunds->receiver_amount }}</b><br/>
		New Balance: <b>{{ $rfunds->receiver_new_balance }}</b>
	</p>		
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>