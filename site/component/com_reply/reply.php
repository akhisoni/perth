<?php 
$locobj = new State();
$locobj1 = $locobj->getAllLocationAds();
$id = isset($_GET['id'])?$_GET['id']:'';
$objpro = new Product();
$objp = $objpro->CheckProduct($id);
if(isset($_POST['submit']))
{
	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
    {
		
        flashMsg("The Validation code does not match!","2");
    } else {
		$objpro->Ad_Enquiry_Request($_POST);
		flashMsg("Thankyou for posting your reply on this ad",1);	
}}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<?php flashMsg(); ?>

<div class="center-content">
  <div class="contianer">
    <div class="bredcram">
      <div class="bred">
        <ul>
          <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
          <li> /</li>
          <li>Reply to this ad</li>
        </ul>
      </div>
      <div class="bred-inner">
        <h1>Reply to this ad</h1>
      </div>
      <div class="inner_content">
     
          <div class="main-classified">
            <form class="form_field_post" action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
          
             <input value="<?php echo $_SESSION['FRONTUSER']['id'];?>" name="user_id" id="user_id"  type="hidden" >
              <input type="hidden" name="product_id" id="product_id" value="<?php echo $objp['id'];?>" />
              <input type="hidden" name="producturl" id="producturl" value="<?php echo $actual_link;?>" />
              <div class="ad-classified">
                <ul>
                  <li>
                    <label>Ad</label>
                    <div class="choose_cat">
                      <div id="category" class="fields"> <span><?php echo $objp['name'];?> </span>
                    </div>
                  </li>
                  <li>
                    <label>Name</label>
                    <input name="name" type="text" value="<?php echo $_SESSION['FRONTUSER']['name'];?>" class="field_form" id="name">
                  </li>
                  </ul></div>
                  
                  <div class="ad_details">
                  <ul>
                  <li>
                    <label>Description</label>
                    <textarea name="description" cols="" rows="" id="description" class="field_form_area" required></textarea>
                  </li>               
                </ul>
              </div>
              
              <div class="ad-classified_video">
                <ul>
                  
                  <li>
                    <label>Email* </label>
                    <input name="email" type="email" value="<?php echo $_SESSION['FRONTUSER']['email'];?>" class="field_form" id="email" required="required">
                   <span></span> </li>
                    <li>
                     <label>Enter Below Code*</label>
                      <input name="6_letters_code" type="text" id="6_letters_code" class="field_form" required="required">
                      <br >
                      <img src="<?php echo SITEURL;?>/itf_ajax/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'>
                      <span> Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh
                      </li>
                  
                 <li>
                    <label>&nbsp </label>
                    <input name="submit" type="submit" value="Submit ad" class="pink">
                  
                  </li>
                  <li>
                </ul>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type='text/javascript'>
    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
</script> 