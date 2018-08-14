<!DOCTYPE html>
<html>
<head>
  <title>Vista Network</title>
</head>

<body>

	Dear <b>{{ $withdraw->first_name }}</b>, <br/>
	<p>
		We have received a request to withdraw the revenues in your Vista Network account. Funds will sent to your Bank account associated with Vista Network.<br/><br/>

		Transaction ID: <b>{{ $withdraw->trans_id }}</b><br/>
		Requested Amount: <b>${{ $withdraw->amount }}</b><br/>
		Payment Gateway: <b>{{ $withdraw->gateway }}</b></br>
	</p>
	<p>
		It will take {{ $withdraw->processing_day }} days in order to process your request. 
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