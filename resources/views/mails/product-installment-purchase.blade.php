<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $product->first_name }}</b>, <br/>
	<p>
		Congratulations! You purchased {{ $product->product_title }} successfully on Installment, product price is ${{ $product->product_price }}.<br/><br/>
		Installment No: <b>{{ $product->payment_no }}</b><br/>
		Installment per Month: <b>{{ $product->installment }}</b><br/>
		Duration: <b>{{ $product->duration }}</b><br/>
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