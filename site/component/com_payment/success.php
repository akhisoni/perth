
<?php 

if(isset($_SESSION['orderid']) and $_SESSION['orderid']!=null)
{
    $payment =  new Payment();
    
    $payment->updatepaymenttable($datas);
}
 ?>
<div style="text-align: center; margin-top: 100px;"> <h3>Thank you for your order.</h3></div>
