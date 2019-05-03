<?php
session_start();
$sell_email = $_SESSION['sell_email'];
$package_id = $_SESSION['package_id'];
$seller_id = $_SESSION['seller_id'];
$session_id = $_SESSION['id'];
$obj = new User();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$objprogram = new Program();
$program =$objprogram->showAllFrontProgram();

$packages = new Package();
$packs = $packages->GetPackageData($package_id);


if(isset($_POST['paymentType']) and ($_POST['paymentType']=="Authorization"))
{
		$environment = $program['paypal_type'];// or 'beta-sandbox' or 'live'
		function PPHttpPost($methodName_, $nvpStr_)
			{
			
			$objprogram = new Program();
			$program =$objprogram->showAllFrontProgram();
			global $environment; 
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = $program['api_username'];
			$API_Password = $program['api_password'];
			$API_Signature = $program['api_secret'];
			$API_Endpoint = "https://api-3t.paypal.com/nvp";
			
			if("sandbox" === $environment || "beta-sandbox" === $environment)
			{
				$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');
			// Set the curl parameters.
			$ch = curl_init();	
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
			// Get response from the server.
			$httpResponse = curl_exec($ch);
			if(!$httpResponse)
			{
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value)
			{
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1)
				{
					$httpParsedResponseAr[$tmpAr[0]] = urldecode($tmpAr[1]);
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr))
			{
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
		}
		
				// Set request-specific fields.
	            $paymentType = urlencode($_POST['paymentType']);				// or 'Sale'
				$firstname = $_POST['name'];
				$lastName = urlencode($_POST['lastName']);
				$email = $_POST['email'];
				$telephone = urlencode($_POST['phone']);
				$creditCardType = urlencode($_POST['creditCardType']); 
				$creditCardNumber = urlencode($_POST['creditCardNumber']);
				$expDateMonth = urlencode( $_POST['expDateMonth']); 
				// Month must be padded with leading zero
				$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
				
				$expDateYear = urlencode($_POST['expDateYear']);
				$cvv2Number = urlencode($_POST['cvv2Number']);
				$address = urlencode($_POST['address']);				
				$city = urlencode($_POST['city']);
				$state = urlencode($_POST['state']);
				$zip = urlencode($_POST['zip']);
				$country = urlencode($_POST['country']);				// US or other valid country code
				$amount = urlencode($_POST['amount']);
				$currencyID = urlencode('USD');
				$planname = $_POST['plan_name'];	
				$planduration = $_POST['plan_duration'];		
				$planid = $_POST['plan_id'];	
				$trans_id = $_POST['trans_id'];	
				$package_id	= $_POST['package_id'];						// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		// Add request-specific fields to the request string.
		$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
					"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
					"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
					
					
		
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);
		//echo "<pre>";
		//print_r($httpParsedResponseAr);
		
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
				{             
						 $userid = $userinfo['user_id'];
						    $email = $sell_email; 
						  $planid = $package_id;
						  $planname = $packs['package_name'];
						 
					      $objpack =new Package();
						 $serialresult = serialize($httpParsedResponseAr);
  $planobj = $objpack->PaymentPlanPostAd($serialresult,$httpParsedResponseAr,$userid,$planid,$planname,$httpParsedResponseAr["ACK"],$firstname,$lastName,$email,$planduration,$paymentType,$session_id);
						 
					   if($planobj!='')
							{
								$_POST['trans_id']= $httpParsedResponseAr['TRANSACTIONID']; 
								$_POST['package_id']= $planid;
								$_POST['session_id']= $session_id;
								$_POST['feature']= 1;
								$_POST['status']= 1;
								$objpro = new Product();
								$objpro->AdUpdateFront($_POST); 
								flashMsg("Your transaction has been successfully completed. Your Ad has been listed");
								 redirectUrl(CreateLink(array("postad&itemid=thanks")));
								
							}
				}
				else
				{
					 flashMsg($httpParsedResponseAr["L_LONGMESSAGE0"]."<br/>".$httpParsedResponseAr["L_LONGMESSAGE1"],2);
				}
}
 ?>
<?php echo flashMsg();?>

<div>&nbsp;</div>
<div>&nbsp;</div>
<div class="center-content">
  <div class="contianer">
    <div class="bredcram">
      <div class="bred-inner">
        <h1>Payment</h1>
      </div>
      <div class="buying_request">
        <div class="buyig_inner">
          <div class="well">
            <h5>&nbsp;Package name : <?php echo $packs['package_name'];?> </h5>
            <h5>&nbsp;Package Price : $ <?php echo $packs['package_prices']; ?></h5>
          </div>
          <h4> Checkout with Paypal </h4>
          <?php 
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'asoni@iwebyinfo.com'; //Business Email
?>
          <a href="<?php echo CreateLink(array("postad","itemid"=>"standard_payment")); ?>&payid=<?php echo $packs['id']; ?>" data-original-title=""><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"></a> </div>
        <div class="buyin_in">
          <h4> Or Checkout with Credit Card </h4>
          <form name="frmregister" id="frmregister" action="" method="post"  enctype="multipart/form-data">
            <input name="session_id" type="hidden" id="session_id" value="<?php echo $session_id;?>" class="field">
            <input name="trans_id" type="hidden" id="trans_id" value="" class="field">
            <input name="feature" type="hidden" id="feature" value="1" class="field">
            <input name="status" type="hidden" id="status" value="1" class="field">
            <input name="package_id" type="hidden" id="package_id" value="<?php echo $packs['id']; ?>" class="field">
            <input name="plan_duration" type="hidden" id="plan_duration" value="<?php echo $packs['package_duration']; ?>" class="field">
            <table>
              <tbody>
                
                <!--  <tr>
            <td class="labelText">Package Price</td>
            <td><input type="hidden" name="amount" value="<?php echo $packs['package_prices']; ?>" class="inpt-box" id="amount" required/></td>
          </tr>-->
                <tr>
                  <td class="labelText">Card Number</td>
                  <td><input type="text" name="creditCardNumber" id="creditCardNumber" maxlength="19" value="" class="inpt-box" required />
                    <input type="hidden" name="paymentType" value="Authorization" /></td>
                </tr>
                <tr>
                  <td class="labelText">Card Type</td>
                  <td><input name="creditCardType" id="creditCardType" type="radio" value="Visa" checked="checked" style="margin:0 0 30px 0;" required/>
                    &nbsp; <img src="<?php echo TemplateUrl();?>images/cart1.png" />&nbsp;&nbsp;&nbsp;
                    <input name="creditCardType" type="radio" value="MasterCard" style="margin:0 0 10px 0;" required/>
                    &nbsp; <img src="<?php echo TemplateUrl();?>images/cart2.png"  />&nbsp;&nbsp;&nbsp;
                    <input name="creditCardType" type="radio" value="Amex" style="margin:0 0 10px 0;"required />
                    &nbsp;<img src="<?php echo TemplateUrl();?>images/cart3.png"  /></td>
                </tr>
                <tr>
                  <td class="labelText">Expiry date</td>
                  <td><select name="expDateMonth" style="width:60px;" class="slel" required>
                      <option value=1>01</option>
                      <option value=2>02</option>
                      <option value=3>03</option>
                      <option value=4>04</option>
                      <option value=5>05</option>
                      <option value=6>06</option>
                      <option value=7>07</option>
                      <option value=8>08</option>
                      <option value=9>09</option>
                      <option value=10>10</option>
                      <option value=11>11</option>
                      <option value=12>12</option>
                    </select>
                    &nbsp;&nbsp;
                    <select name="expDateYear" style="width:100px;" class="slel">
                      <option value=2017>2017</option>
                      <option value=2018 >2018</option>
                      <option value=2019>2019</option>
                      <option value=2020>2020</option>
                      <option value=2021>2021</option>
                      <option value=2022>2022</option>
                      <option value=2023>2023</option>
                      <option value=2024>2024</option>
                      <option value=2025>2025</option>
                      <option value=2026>2026</option>
                      <option value=2027>2027</option>
                      <option value=2028>2028</option>
                      <option value=2029>2029</option>
                      <option value=2030>2030</option>
                      <option value=2031>2031</option>
                    </select></td>
                </tr>
                <tr>
                  <td class="labelText">CVV</td>
                  <td><input name="cvv2Number" value="" type="text" class="inpt-box" required/></td>
                </tr>
                <tr>
                  <td><input type="hidden" name="country" id="country" value="AUS"  class="inpt-box"></td>
                  <td><input type="submit" name="paymentplan" value="Submit"  class="all_button1"/></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
    -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	width:95%;
	margin-left:10px;
}
h4 {
    margin-left: 25px;
    margin-top: 20px;
}

.buyig_inner img { margin-left:20px; margin-top:20px;}
</style>
