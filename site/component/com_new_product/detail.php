<?php
$objProduct = new Product();
$objCategory = new Category();
$id = isset($_GET['id'])?$_GET['id']:'';
$productInfo = $objProduct->CheckProduct($id);
$imge = unserialize($productInfo['image']);
$breadcrumb = $objCategory->getBreadcumProduct($productInfo['category_id']);
$objloc = $objProduct->GetLocationName($productInfo['location']);

$obj = new User();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_POST['submit']) && !empty($_POST['email'])){          
$objProduct->Add_Buying_Request_Details($_POST);
flashMsg("You have successfully Place the Enquiry");
//redirectUrl(CreateLink(array("buy_request")));
}
?>
<div class="center-content">
<div class="contianer">
<div class="bredcram">
<div class="bred">
<ul>
<li> <a href="<?php echo SITEURL; ?>">Home / </a></li>
<li> <?php echo $breadcrumb; ?>  </li>
<li><?php echo $productInfo['name']; ?></li>
</ul>
</div>
<div class="bred-inner">
  <h1><?php echo $productInfo['name']; ?></h1>
</div>
</div>

<div class="listing">
<div class="left-imge-l">
  <div class="flexslider carousel flexslider1">
  <ul class="slides">
<?php foreach($imge as $imagevalue){?>
<li><a rel="<?php echo $imagevalue; ?>"><img src="<?php echo PUBLICPATH."products/".$imagevalue; ?>" width="252px;" height="176px;" /></a></li>  
<?php } ?>

</ul>
</div>
<script>// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider1').flexslider({
    animation: "slide"
  });
});</script>
</div>
<div class="right-imge-l">
  <h2><?php echo $productInfo['name']; ?></h2>
  <p class="det-text"><?php echo $productInfo['logn_desc']; ?></p>
  <p class="date-in">
  <strong>Date posted: </strong>
  <?php echo date("j M, Y", strtotime(date($productInfo['entrydate'])) );?>&nbsp;   |
  <strong>&nbsp;  Location: </strong><?php echo $objloc['name'];?> -<a href="#mydiv" onclick="show('mydiv')">map</a><br>
    <strong>Ad Id</strong>: <?php echo $productInfo['id']; ?>  </p>
     <p class="aud1"><?php if($productInfo['price']==''){
                  if($productInfo['opt_price']=='2') echo "Free";
				   if($productInfo['opt_price']=='3') echo "Please contact";
				   if($productInfo['opt_price']=='4') echo "Swap / Trade ";
				  
				  ?>
                  <?php }else {?>
					  AUD <?php echo $productInfo['price'];
					  ?>
                  <?php }?></p>
  <p ><img src="<?php echo TemplateUrl();?>images/reply-btton.png" width="174" height="40" alt=""/><img src="<?php echo TemplateUrl();?>images/add-btn.png" width="187" height="40" alt=""/></p>
  <p >&nbsp;</p>
  
  
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_plusone_large' displayText='Google +1'></span>
<span class='st_email_large' displayText='Email'></span>
<div id="mydiv">
 <a href="#" onclick="hide('mydiv')" class="clos"><img src="<?php echo TemplateUrl();?>images/close.png"/></a>
<iframe  width="425px;" height="350px;" src="http://maps.google.com/maps?q=<?php echo $objloc['name'];?>&z=15&output=embed"></iframe>
   </div>
</div>

</div>


</div>

</div>


<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ae745e8b-e1f2-4c24-a5e8-4e870b515058", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<script>function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}
</script>

<style>
#mydiv {
display:none;
}
.clos {
    float: right;
    margin: 0 56px -10px 0;
}
</style>


