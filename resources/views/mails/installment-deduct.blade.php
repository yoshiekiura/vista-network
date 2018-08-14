<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $install->first_name }}</b>, <br/>
	<p>
		This is an automated message to confirm that your installment ${{ $install->amount }} for product {{ $install->product_name }} has been pay out. 
	</p>
	<p>
		<b>Transaction Details</b><br/><br/>
		Transaction ID: <b>{{ $install->trans_id }}</b><br/>
		Amount: <b>${{ $install->amount }}</b><br/>
		Installment #: <b>{{ $install->install_no }}</b><br/>
		Remaining Amount: <b>${{ $install->remaining_amount }}</b>
	</p>		
	<br/>
	Thank You,
	<br/>
	<i>Vista Network</i>

</body>
</html>