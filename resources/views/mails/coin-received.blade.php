<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $coin->receiver_first_name }}</b>, <br/>
	<p>
		Congratulations! You have received {{ $coin->coin_number }}&nbsp;{{ $coin->coin_name }} from <b>{{ $coin->giver_first_name }}&nbsp;{{ $coin->giver_last_name }}</b>.<br/><br/>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>