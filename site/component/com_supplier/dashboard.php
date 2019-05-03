<?php 
error_reporting(0);
//print_r($_SESSION['FRONTUSER']);
$mode = $_REQUEST['mode']; 
if(empty($_SESSION['FRONTUSER']))
{
   redirectUrl(CreateLink(array("signin")));
}
$countries = $objsite->getCountries();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$category_ids = explode(",",$userinfo['product_group_id']);
$serviceObj = new ServiceCategory();
$services = $serviceObj->getCategories();
$categoryObj = new Category();
$categories = $categoryObj->getCategories();
foreach($categories as $category)
{
    $cats[$category['id']] = $category['catname'];
}

$showCat = array();

foreach($category_ids as $ids){
    if (array_key_exists($ids, $cats)) {
        $showCat[$ids] = $cats[$ids];
        unset($cats[$ids]);
    }
}
$categoriesData = implode('","',$cats);
$categoriesdisplay = implode(', ',$cats);
$quote = new Quote();
$enquiries = $quote->getEnquiryByLocation($userinfo['city_id'],$userinfo['service_category']);
$bids = $quote->getBids();
$state = new State();
$areas = $state->getAllStateFront();
$finalizeData = $quote->getOrder();
$activeQuotes = $quote->getActiveQuoteByLocation($userinfo['city_id']);
$closedQuotes = $quote->getClosedQuoteByLocation($userinfo['city_id']);
if(isset($_POST['submit'])){

    if(!empty($_POST['emailid'])){
        if(!empty($_POST['change_password'])){
            $obj->ChangePasswordFront($_POST['change_password']);
        }

        $obj->front_user_update($_POST);
        flashMsg("Success: Your profile is modified.");
        redirectUrl(CreateLink(array("supplier&mode=profile")));
    }

    if(isset($_POST['category'])){
        if(!empty($_POST['category'])){
            $ret = $obj->addCategory($_POST);           
            if($ret==1){flashMsg("Error: You Have Entered Invalid Category Name ",2);}
            elseif($ret==2){flashMsg("Error: Category Name Already Present ",2);}
            elseif($ret==3){flashMsg("Success: ".$_POST['category']." have been added in your profile .");}
            
            redirectUrl(CreateLink(array("supplier&mode=category")));
        }else{
            flashMsg("Error: Please enter category ",2);
            redirectUrl(CreateLink(array("supplier&mode=category")));
        }
    }

    if(!empty($_POST['paypal_id'])){
        $rest = $totalMoney - $_REQUEST['withdraw_money'];
        $data = array('user_id'=>$_SESSION['FRONTUSER']['id'],'total_amount'=>$totalMoney, 'withdraw_amount'=>$_POST['withdraw_money'], 'balance'=>$rest );
        $quote->addMoney($data);
        flashMsg("Success: Your request is submitted.");
        redirectUrl(CreateLink(array("supplier")));
    }

    if(!empty($_POST['bid_amount'])){
        $quote->addBid($_POST);
        redirectUrl(CreateLink(array("supplier&mode=bids")));
    }

    if(!empty($_POST['product_name'])){
        $userobj = new User();
        $maildatavalue = $userobj->GetEmail(11);
        $admin_mail = $userobj->Get_User(1);

        if(isset($_FILES['image']['name'])){
            if(!empty($_FILES['image']['name'])){
                $fimgname="plucka_".rand();
                $objimage= new ITFImageResize();
                $objimage->load($_FILES['image']['tmp_name']);
                $objimage->save(PUBLICFILE."products/".$fimgname);
                $imagename = $objimage->createnames;

            }
        }
        
        
        
        $file = PUBLICFILE."/products/".$imagename;
        $filename=$imagename;
         //$file = $path . "/" . $filename;
$to = 	$admin_mail['email'];

 $subject=$maildatavalue['mailsubject'];
 $url=SITEURL;
 $from=$admin_mail['email'];
$bound_text = 	"jimmyP123";
$bound = 	"--".$bound_text."\r\n";
$bound_last = 	"--".$bound_text."--\r\n";

    $headers =  "From: Plucka Helping Hand <".$from."> \r\n";  	 
//$headers = 	"From:".$admin_mail['email']."\r\n";
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
<p>Hi Admin,</p><br><br>
<p>" .$_SESSION['FRONTUSER']['name']. " want to add product in your site,</p><br>
<p>Details of products are given below:</p>
<p>Product Name : " .$_POST['product_name']."   </p>
<p>Product Details : ".$_POST['detail']." </p>
<p>Image : In attachment </p>

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
  	
  	.$bound;
  	 
$files = 	file_get_contents($file);
  	 
$message .= 	"Content-Type: image/jpg; name=\".$filename.\"\r\n"
  	."Content-Transfer-Encoding: base64\r\n"
  	."Content-disposition: attachment; file=\".$filename.\"\r\n"
  	."\r\n"
  	.chunk_split(base64_encode($files))
  	.$bound_last;

mail($to, $subject, $message, $headers);
flashMsg("Success: Your request is successfully sent !.");
        redirectUrl(CreateLink(array("supplier")));
   }
 }
?>
<style>.supply_lft {
width: 120px;
padding: 5px 20px;
}</style>
<section class="section">
<div class="center_main">
<div class="home"><a href="<?php echo SITEURL; ?>">Home</a> / <a href="<?php echo CreateLink(array('dashboard')); ?>"><span>Dashboard</span></a></div>
<div style="padding-top:25px;">
<ul class="tabs" style="border-bottom:2px #b6b6b6 solid;">
    <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=home" id="tab11">Dashboard</a></li>
    <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=profile" id="tab81">My Profile</a></li>
    <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=category" id="tab31">Add Category</a></li>
    <li><a class="" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=listcategory" id="tab31">My Categories</a></li>
  <!--  <li><a class="" href="?itfpage=supplier&mode=browsequote" id="tab51">Browse Quotes</a></li>
    <li><a class="" href="?itfpage=supplier&mode=bids" id="tab41">My Bids</a></li>
    <li><a class="" href="?itfpage=supplier&mode=activequote" id="tab61">Active Quote</a></li>
    <li><a class="" href="?itfpage=supplier&mode=closedquote" id="tab71">Closed Quote</a></li>-->
    <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=addproduct" id="tab91">Add Catalogue</a></li>
     <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=listproduct" id="tab91">My Catalogue</a></li>
     <?php  if($_SESSION['FRONTUSER']['usertype'] == 4)
    {?>
		  <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=mybuyingrequest" id="tab91">My Buying Request</a></li>
   <?php  } ?>
      <li><a class="#" href="<?php echo SITEURL; ?>/index.php?itfpage=supplier&mode=listbuying" id="tab91">My Offer</a></li>
</ul>

<?php 
//flashMsg("You have transferred to the Supplier Area.");
     switch($mode)
	 {
     	 case "home":
			include('home.php');
		    break;
		
	     case "profile":
		   include('myprofile.php');
	      break;
		  
		  case "category":
		   include('category.php');
	      break;
		    case "listcategory":
		   include('listcategory.php');
	      break;
		  
		  case "browsequote":
		   include('browsequote.php');
	      break;
		  
		  case "bids":
		   include('bids.php');
	      break;
		  
		   case "activequote":
		   include('activequote.php');
	      break;
		  
		   case "closedquote":
		   include('closedquote.php');
	      break;
		  
		   case "addproduct":
		   include('addproduct.php');
	      break;
		    
		   case "editproduct":
		   include('addproduct.php');
	      break;
		  
		   case "listproduct":
		   include('listproduct.php');
	      break;
		  
		  
		  
		  case "listbuying":
		   include('listbuying.php');
	      break;
		  
		    
		   case "viewchat":
		   include('viewchat.php');
	      break;
		  
		    case "mybuyingrequest":
		   include('mybuyingrequest.php');
	      break;
		  
		    
		    case "details":
		   include('quotedetails.php');
	      break;
		  
		   case "chatdetail":
		   include('chatdetail.php');
	      break;
		  
		  
	  default:
			include('home.php');
	 }
	 ?>
     </div> </div>
</section>
   

<!-- <div id="mydialog" title="Bid Detail" style="display:none;">
    <p>Bid Detail</p>       
</div>
<div id="mydialog1" title="Quote Detail" style="display:none;">
    <p>Quote Detail</p>       
</div>
 -->
<script language="javascript" src="<?php echo TemplateUrl();?>js/jquery.validate.js"></script>
<script type="text/javascript">
	
	function ChangeMessage(Message) {           
            $("#mydialog").html(Message);
        }

    $(function(){

        $('.addproduct').validate({
            rules: {
                name :{required:true},
                logn_desc: {required:true},
				code: {required:true},
				category_id: {required:true},

            },
            messages: {
                image:{accept:'File must be jpg | png | gif extension '}
            }
        });
		
		$('#info').validate({
            rules: {
                catname :{required:true},
                detail: {required:true},
            },
            messages:{
            }
        });
      $('.my_pro').validate({
            rules: {
                name:{required:true, maxlength:100, noSpace: true},
				 company_name:{required:true, maxlength:100, noSpace: true},
                last_name:{required:true, maxlength:100, noSpace: true},
                address:{required:true, maxlength:100, noSpace: true},
                change_password:{minlength:8, maxlength:20, noSpace: true},
				emailid: {required:true, email:true,},
                //payment_type:"required"

            },
            messages: {
                name:{required:"You must fill in all of the fields !"},
                last_name: {required:"You must fill in all of the fields !"},
                address: {required:"You must fill in all of the fields !" },
               // payment_type: "You must fill in all of the fields !",
				emailid: {required: "You must fill in all of the fields !"},	
                change_password:{ required: "You must fill in all of the fields !"}

            }
        });


    });




</script>
