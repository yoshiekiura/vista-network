<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $coin->first_name }}</b>, <br/>
	<p>
		This is to inform you that Vista Network administration has deducted {{ $coin->coin_number }}&nbsp;{{ $coin->coin_name }} from your account.<br/><br/>

		New {{ $coin->coin_name }}&nbsp;Balance: <b>{{ $coin->coin_balance }}</b><br/>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>