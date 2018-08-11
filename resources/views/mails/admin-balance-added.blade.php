<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $balance->first_name }}</b>, <br/>
	<p>
		Congratulations! You have received ${{ $balance->amount }} from <b>Vista Network</b>.<br/><br/>
		New Balance: <b>{{ $balance->balance }}</b><br/>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>