<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $hashpower->first_name }}</b>, <br/>
	<p>
		Congratulations! You purchased {{ $hashpower->product_title }} successfully, product price is ${{ $hashpower->product_price }}.<br/><br/>
		HP Transaction ID: <b>{{ $hashpower->trans_id }}</b><br/>
		HP Current Balance: <b>${{ $hashpower->hp_balance }}</b>
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