<?php
$p = new Paypal();             // initiate an instance of the class
$c = new Quote();
$payment =  new Payment();
$total =0;




$userobj=new User();
$packagaes=new Package();

$id= $_REQUEST['payid'];
	$amount=$packagaes->GetPackageData($id);
	 $counter = $key+1;
//$userinfo = $obj->getFruntUserInfo($_SESSION['FRONTUSER']['USERPROFILEID']);

$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

$success_url = SITEURL.'/'.CreateLink(array("postad","itemid"=>'standard_payment_success'));
$cancel_url = SITEURL.'/'.CreateLink(array("postad","itemid"=>'cancel'));
$notify_url = SITEURL.'/'.CreateLink(array("postad","itemid"=>'ipn'));
$item_no = time();

$p->add_field('business', 'asoni@iwebyinfo.com');
$p->add_field('return', $success_url);
$p->add_field('cancel_return', $cancel_url);
$p->add_field('notify_url', $notify_url);
$p->add_field('custom', $item_no);
//$p->add_field('item_number_', $item_no);


	
	
$p->add_field('item_name_'.$counter,$amount['package_name'].'('. $amount['package_duration'].$amount['package_prices'].')');
$p->add_field('amount_'.$counter, $amount['package_prices']);
$p->add_field('item_number_'.$counter,$item_no);
$nojob3= date('Y-m-d h:i:s', strtotime("+".$amount['package_duration'], strtotime(date("Y-m-d h:i:s"))));



echo $sql= "Insert into itf_payment (payment_amount,payer_email,payer_id,package_id,exp_date,package_name,item_no,premium) values('".$amount['package_prices']."','".$userinfo['email']."','".$_SESSION['FRONTUSER']['USERPROFILEID']."','".$amount['id']."','".$nojob3."','".$amount['package_name']."','".$item_no."','0')";

mysql_query($sql);

$p->paypalPost(); // submit the fields to paypal
$p->dumpFields();      // for debugging, output a table of all the fields

?>