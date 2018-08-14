<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $gfunds->giver_first_name }}</b>, <br/>
	<p>
		You have successfully transfered funds from your account to <b>({{ $gfunds->receiver_username }})</b> account.
	</p>
	<p>
		The following transaction has been debited from your account.<br/>
		<b>Transaction Details</b><br/>

		Transaction ID: <b>{{ $gfunds->giver_trans_id }}</b><br/>
		Amount: <b>${{ $gfunds->giver_amount }}</b><br/>
		New Balance: <b>{{ $gfunds->giver_new_balance }}</b>
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