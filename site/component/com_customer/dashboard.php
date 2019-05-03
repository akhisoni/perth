<script language="javascript" src="<?php echo TemplateUrl();?>js/jquery.validate.js"></script>
<?php
Html::AddJavaScript("customer/assests/jquery.js","component");
Html::AddStylesheet("customer/assests/jquery-ui-timepicker-addon.css","component");
$objProduct = new Product();$objCategory = new Category(); //This is used to put product parent category name on Quote Request page.
if(empty($_SESSION['FRONTUSER'])){
 
    redirectUrl(CreateLink(array("signin")));
}
$mode = $_REQUEST['mode'];
$countries = $objsite->getCountries(); 
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$quote = new Quote();
//$quote_info = $quote->getQuote();
$state = new State();
$areas = $state->getAllStateFront();
$serviceObj = new ServiceCategory();
$services = $serviceObj->getCategories();
$categoryObj = new Category();
$cats = $categoryObj->getCategories();
$categories = array();
foreach($cats as $categorys)
{
    foreach($categorys['subcat'] as $subcat){
        foreach($subcat['subcat'] as $subsubcat){
            $categories[] = $subsubcat;
        }
    }
}
//$finalizeData = $quote->getOrder();
//$carts = $quote->getCart();
//$activeQuotes = $quote->getActiveQuote();
//$closedQuotes = $quote->getClosedQuote();
//$expiredQuotes = $quote->getExpiredQuote();
//$transactions = $quote->getAllTransactions();
$quoteobj = new Quote();
    if(@$_POST['bid_submit'])
	{  
        $quote->changedBidStatus($_POST);
        flashMsg("Your bid status is changed.");
        redirectUrl(CreateLink(array("customer&mode=active")));
    }


if(isset($_POST['submit'])){

    if(!empty($_POST['emailid'])){
        if(!empty($_POST['change_password'])){
            $obj->ChangePasswordFront($_POST['change_password']);
        }

        $obj->front_user_update($_POST);
        flashMsg("Your profile is modified.");
        redirectUrl(CreateLink(array("customer&mode=profile")));
    }
    
   

  //  if(!empty($_POST['quote_name'])){
//
//        $quote->addQuote($_POST);
//        flashMsg("Success: Your Quote is successfully created ");
//        redirectUrl(CreateLink(array("customer&mode=enquiry")));
//    }

    if(!empty($_POST['quote_name'])){
        $prodata = array();

        if(isset($_FILES['product_image']['name']) and !empty($_FILES['product_image']['name']))
        {
            $fimgname="plucka_".rand();
            $objimage= new ITFImageResize();
            $objimage->load($_FILES['product_image']['tmp_name']);
            $objimage->save(PUBLICFILE."products/".$fimgname);
            $imagename = $objimage->createnames;
        }
        $prodata = array('main_image'=>$imagename,'code'=>'CP'.time(),'logn_desc'=>$_POST['product_desc'],'special_req'=>$_POST['special_req']);
        $product = new Product();
        $product_id= $product->admin_add($prodata);
        $quote_data = array('product_id'=>$product_id,'quote_name'=>$_POST['quote_name'],'service_id'=>$_POST['serviceGroup'],'quantity'=>$_POST['quantity'],'location'=>$_POST['location'],'service_cat'=>$_POST['service_cat'],'finish_time'=>$_POST['finish_time']);
        $quote->addCustomQuote($quote_data);
        flashMsg("Success: Your have created a custom quote !");
        redirectUrl(CreateLink(array("customer&mode=enquiry")));

    }

    if(!empty($_POST['bid_check']) ){
	//echo "<pre>";print_r($_POST['bid_check']);
	foreach($_POST['bid_check'] as $bidid)
	{
	   $supp_id = $quote->getsupplier($bidid);//echo "<pre>";print_r($supp_id);die;
	   $supp_data = $quote->getsupplierbyid($supp_id['user_id']);
	   //echo $sup_email = $supp_data['email'];
	   $to = 	$supp_data['email'];

 $subject='BID ACCEPTED';
 $url=SITEURL;
 $from=$supp_data['email'];
$bound_text = 	"jimmyP123";
$bound = 	"--".$bound_text."\r\n";
$bound_last = 	"--".$bound_text."--\r\n";

    $headers =  "From: Plucka Helping Hand <".$from."> \r\n";  	 
//$headers = 	"From:".$supp_data['email']."\r\n";
$headers .= 	"MIME-Version: 1.0\r\n"
  	."Content-Type: multipart/mixed; boundary=\"$bound_text\"";
  	 
$message .= 	"If you can see this MIME than your client doesn't accept MIME types!\r\n"
  	.$bound;
  	 
$message .= 	"Content-Type: text/html; charset=\"iso-8859-1\"\r\n"
  	."Content-Transfer-Encoding: 7bit\r\n\r\n"
       ." 
           <body>
<table width='642' border='1' align='center' cellpadding='5' cellspacing='0'>
  <tr>
    <td height='83' style='font-size:25px;'>
	<a href='http://trade2rise.com/project/' style='color:#FFFFFF;'><img border='1' src='http://trade2rise.com/project/plucka/template/default/images/logo.png' title='Plucka Helping Hand'></a></td>
  </tr>
  <tr>
  <td>
<p>Hi </p><br><br>
<p>A bid has been accepted with following information.,</p><br>
<p>Details are given below</p><br>
<p>Bid Description : " .$supp_id['bid_desc']."   </p>
<p>Bid Amount : ".$supp_id['bid_amount']." </p>
   <br />
              <br />
     <p> <strong>Thanks and Regards<br />
	 &nbsp;&nbsp;Plucka Helping Hand </strong></p></td>
  </tr>
  <tr>
    <td height='52' align='center' style='font-size:12px;'><a href='' style='color:#000000;'>Plucka Helping Hand</a></td>
  </tr>
</table>
</body>
"
  	
  	.$bound_last;
  	 

  	 


mail($to, $subject, $message, $headers);  
	 
    /*     
         $maildatavalue = $this->GetEmail(19);
		 $objmail = new ITFMailer();
		 $objmail->SetSubject($maildatavalue['mailsubject']);
		 $objmail->SetBody($maildatavalue['mailbody'],array('quote'=>$supp_id['quote_id'],'name'=>$supp_id['bid_desc'],"time"=>$supp_id['bid_amount']));
		 $objmail->SetTo($sup_email);
		 $objmail->MailSend(); */
	}
	//die;
    $quote->addCart($_POST);
$p = new Paypal();            
$c = new Quote();
$payment =  new Payment();
$total =0;
$carts = $c->getCart();
foreach($carts as $cart){
  $quote_id = $cart['quote_id'];
    $total += $cart['bid_amount'];
}
$datas = array(
       'user_id'=> $_SESSION['FRONTUSER']['id'],
      'quote_id'=> $quote_id,
      'quantity'=> count($carts),
        'amount'=> $total
);
//echo '<pre>'; print_r($datas); exit;
$order_id = $payment->addOrder($datas);
//echo "<pre>";print_r($order_id);die;
//echo "beofr unset"."<pre>";print_r($_SESSION);
unset($_SESSION['orderid']);
unset($_SESSION['quote_id']);
$_SESSION['orderid']=$order_id;
$_SESSION['quote_id']= $quote_id;
//echo "after unset"."<pre>";print_r($_SESSION);die;
foreach($carts as $cart){
    $orderData = array(
                'order_id'=>$order_id,
                'bid_id'=>$cart['id'],
                'amount'=>$cart['bid_amount']
    );

   $detail_id = $payment->addOrderDetails($orderData);
}
        
  $payment->confirmOrder($order_id);
 
    
	 
	 
	 
        redirectUrl(CreateLink(array("customer&mode=active")));
    }
  
}

 $payment_type=$obj->Get_User($_SESSION['FRONTUSER']['id']);
 
 $pay= $payment_type['payment_type'];

 
?>

<script>
function deleteclosequt(quoteid)
{
var r =confirm("Are you sure want to delete this quote");
		if (r==true)
		  {		  
		  }
		else
		  {
		 return false;
		  }
   var detclosequote = 'detclosequote';
   $.post("<?php echo SITEURL; ?>itf_ajax/index.php", { quoteid: quoteid,itfpg:detclosequote },	
			function(result){
            //alert(result);			
				if(data.res == 'error'){
                    alert("Quote can not be deleted !");
                    return false;
                }else{
                    window.location = ("<?php echo CreateLink(array('?itfpage=customer&mode=closed')); ?>");
                    window.location.reload(true);
                }
				
		});
       
    }

function discardBida(id){
var discardBida = 'discardBida';
$.post("<?php echo SITEURL; ?>itf_ajax/index.php", { id: id,itfpg:discardBida },	
			function(result){				
				if(data.res == 'error'){
                    alert("Accepted bid can not be deleted !");
                    return false;
                }else{
                    document.location.href='?itfpage=supplier&mode=closed';
                    window.location.reload(true);
                }
				
		});
       
    }
    // Wait until the DOM has loaded before querying the document
</script>

    <script type="text/javascript">

        $(document).ready(function() {

            $.validator.addMethod("noSpace", function(value, element) {

                var resinfo = parseInt(value.indexOf(" "));

                if(resinfo == 0 && value !="") { return false; } else return true;

            }, "Space are not allowed as first string !");

            $('#info').validate({
                rules: {
                    name:{required:true, maxlength:'100', noSpace: true},
                    last_name:{required:true, maxlength:'100', noSpace: true},
                    address:{required:true, maxlength:'100', noSpace: true},
					    emailid: {required:true, email:true,},
                    change_password:{minlength:8, maxlength:20, noSpace: true},
                   // payment_type:"required"

                },
                messages: {
                    name:{required:"You must fill in all of the fields !"},
                    last_name: {required:"You must fill in all of the fields !"},
                    address: {required:"You must fill in all of the fields !" },
					  emailid: {required: "You must fill in all of the fields !"},
                    //payment_type: "You must fill in all of the fields !",
                    change_password:{ required: "You must fill in all of the fields !"}

                }
            });


        });
    </script>

<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li>Dasboard</li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Dasboard</h1>
  </div>
  
<div class="inner_content">
<div class="dashboard_link">
<ul class="tabs" style="border-bottom:2px #b6b6b6 solid;">
  
    <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=customer&mode=profile" id="tab71" >My Profile</a></li>
    <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=customer&mode=myads" id="tab31">My Free Ads</a></li>
    <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=customer&mode=mypaidads" id="tab31">My Paid Ads</a></li>
        <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=customer&mode=myfav" id="tab31">My Favourite Ads</a></li>

  
</ul>
<?php
 switch($mode)
	 {
     	 case "home":
			include('myprofile.php');
		    break;
		
	     case "profile":
		   include('myprofile.php');
	      break;
		  
		  case "myads":
		   include('myads.php');
	      break;
		  
		  case "details":
		   include('addetails.php');
	      break;
		  
		  
		   case "myfav":
		   include('myfav.php');
	      break;
		    case "mypaidads":
		   include('mypaidads.php');
	      break;
		  
		  case "paiddetails":
		   include('paidaddetails.php');
	      break;
		  
		  
	  default:
			include('myprofile.php');
	 }?>
</div>
</div>
</div>
</div>






</div>
