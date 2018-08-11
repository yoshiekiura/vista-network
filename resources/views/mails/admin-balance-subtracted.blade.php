<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $balance->first_name }}</b>, <br/>
	<p>
		This is to inform you that Vista Network administration has deducted {{ $balance->amount }} from your account.<br/><br/>

		New Balance: <b>{{ $balance->balance }}</b><br/>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>