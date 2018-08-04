<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $ship->first_name }}</b>, <br/>
	<p>
		You order {{ $ship->order_id }} have successfully processed!<br/>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>
