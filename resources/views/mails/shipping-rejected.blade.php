<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $ship->first_name }}</b>, <br/>
	<p>
		Your buy request order {{ $ship->order_id }} have been rejected and product price added to your account!<br/>
	</p>	
	<p>
		{{ $ship->message }}
	</p>
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>
