<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $coin->first_name }}</b>, <br/>
	<p>
		Congratulations! You have successfully withdraw/sold {{ $coin->coin_number }}&nbsp;{{ $coin->coin_name }}, coin rate is ${{ $coin->coin_rate }}.<br/><br/>
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