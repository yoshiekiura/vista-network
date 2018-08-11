<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $coin->giver_first_name }}</b>, <br/>
	<p>
		Congratulations! You have successfully transfer {{ $coin->coin_number }}&nbsp;{{ $coin->coin_name }} to <b>{{ $coin->receiver_first_name }}&nbsp;{{ $coin->receiver_last_name }}</b>.<br/><br/>
		Coin Transaction ID: <b>{{ $coin->trans_id }}</b><br/>
		{{ $coin->coin_name }} Balance: <b>{{ $coin->coin_balance }}</b>
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