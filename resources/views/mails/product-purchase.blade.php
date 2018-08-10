<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $product->first_name }}</b>, <br/>
	<p>
		Congratulations! You purchased {{ $product->product_title }} successfully, product price is ${{ $product->product_price }}.<br/><br/>
		Transaction ID: <b>{{ $product->order_id }}</b><br/>
		Current Balance: <b>${{ $product->balance }}</b><br/><br/>
		Your current Shopping Status is pending, wait for approval.
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