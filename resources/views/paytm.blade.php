<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Check Out Page</title>
    <meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
<form method="post" id="autosubmit" action="{{ '//localhost:8000/PaytmKit/pgRedirect.php' }}">
	
    <input type="hidden" name="ORDER_ID" value="{!! $order_id !!}">
	<input type="hidden" name="CUST_ID" value="{!! 'PRA'.Auth::user()->email !!}"></td>
    <input type="hidden" name="INDUSTRY_TYPE_ID" value="PrivateEducation"></td>
    <input type="hidden" name="CHANNEL_ID" value="WEB">
  
    <input type="hidden" name="TXN_AMOUNT" value="{!! $amount !!}">
  
</form>
<script>
    document.getElementById('autosubmit').submit();
</script>
</body>
</html>