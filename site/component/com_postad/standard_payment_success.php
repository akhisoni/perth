<?php
$item_no            = $_REQUEST['item_number'];
$item_transaction   = $_REQUEST['tx']; // Paypal transaction ID
$item_price         = $_REQUEST['amt']; // Paypal received amount
$item_currency      = $_REQUEST['cc'];
$status             = $_REQUEST['st']; // Paypal received currency type//
$url                = $_REQUEST['cm']; 


$sql = "select * from itf_payment";
$mysql = mysql_query($sql);
while($skl = mysql_fetch_array($mysql))
{
$itemno = $skl['item_no'];	

if($url == $itemno)
{
	
      $sdf = "update itf_payment  set txn_id='".$item_transaction ."', mc_currency='".$item_currency."', payment_status='".$status."'  where item_no ='".$url."'";
	  mysql_query($sdf);



    $content = "<h1>Thank You!</h1>";
    $content .= "<p style='height:400px; text-align:center'>Your payment has been received. Thank you for posting Ad !</p></h1>";
	
	}

else
{
    $content = "<h1>Payment Failed</h1>";
}


	
	}



//Rechecking the product price and currency details
//if($payment_gross==$price || $item_currency==$currency)
//{
//	
//	
//    $content = "<h1>Welcome, Guest</h1>";
//    $content .= "<h1>Payment Successful</h1>";
//	
//	$sql = "";
//}
//else
//{
//    $content = "<h1>Payment Failed</h1>";
//}
//
//$title = "PayPal Payment in PHP";
//$heading = "Welcome to PayPal Payment PHP example.";
//
echo $content ;
?>