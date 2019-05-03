<?php 
session_start();
$locobj = new State();
$locobj1 = $locobj->getAllLocationAds();
$packobj = new Package();
$pack =  $packobj->ShowAllPackageFront();
$_SESSION['sell_email'] = $_POST['sell_email'];
$_SESSION['package_id'] = $_POST['package_id'];
$_SESSION['id'] =$_POST['session_id'];


$objpro = new Product();
if(isset($_POST['submit']))
{
	

	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
    {
		
        flashMsg("The Validation code does not match!","2");
		
    } elseif($_POST['ad_type']=='0') {		
		
		$objpro->AddFrontEndAds($_POST);
		flashMsg("Thankyou for posting your Ad. Your advert will be reviewed and made live shortly",1);	
		
}else {
	
$objpro->AddFrontEndAds($_POST);
		flashMsg("Please fill the payment details for paid ads",1);		
	    redirectUrl(CreateLink(array("postad&itemid=payment")));
	}

}

$categoryobj=new Category();
$getCatName=$categoryobj->getCatNameValue($_REQUEST['catid']);
$getSubcatName = $categoryobj->getCatNameValue($_REQUEST['subid']);
//echo 'https://maps.google.com/maps/api/geocode/json?address="'.$_POST['zip'].'"';
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$_POST['zip']);

$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;
//die;
?>
<script>

function myFunction()
{
	
	

	var FileInputsHolder 	= $('#AddFileInputBox');

	var MaxFileInputs		= 5; //Maximum number of file input boxs

	var i = $('#AddFileInputBox .multifileblock').size() + 1;

	

		if(i < MaxFileInputs)

			{

		$('<div class="ffg"><div class="multifileblock"><div class="addmorefiles"><input type="file" id="fileInputBox" size="20" name="image[]" class="addedInput"/><div class="smalladdmore"><img src="<?php echo TemplateUrl();?>images/close_icon.png" border="0" onclick="AddMoreImagesClose()" id="removeFileBox" /></div><div class="clear"></div></div></div></div>').appendTo(FileInputsHolder);

				i++; }

			return false;

	}

///////////////////////////////////////////////////////

function AddMoreImagesClose()

	{

		var i = $('#AddFileInputBox .multifileblock').size() + 1;

		if( i > 1 ) {

					$('#removeFileBox').parents('.multifileblock').remove();i--;

			}

			return false;

	}



$(document).ready(function(){
    $('input[type=radio][name=opt_price]').click(function(){
        var related_class=$(this).val();
        $('.'+related_class).prop('disabled',false);
        
        $('input[type=radio][name=opt_price]').not(':checked').each(function(){
            var other_class=$(this).val();
            $('.'+other_class).prop('disabled',true);
        });
    });
});
</script>
<?php flashMsg(); ?>

<div class="center-content">
  <div class="contianer">
    <div class="bredcram">
      <div class="bred">
        <ul>
          <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
          <li> /</li>
          <li>Create your ad</li>
        </ul>
      </div>
      <div class="bred-inner">
        <h1>Create your ad</h1>
      </div>
      <div class="inner_content">
        <div class="main-classified">
          <form class="form_field_post" action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
            <input value="<?php echo time(); ?>" name="session_id" id="session_id"  type="hidden" >
            <input value="0" name="status" id="status"  type="hidden" >
            <input value="<?php echo $_SESSION['FRONTUSER']['id'];?>" name="seller_id" id="seller_id"  type="hidden" >
            <input type="hidden" name="category_id" id="category_id" value="<?php echo $getCatName['id'];?>" />
            <input type="hidden" name="lat" id="lat" value="<?php echo $latitude;?>" />
            <input type="hidden" name="lon" id="lon" value="<?php echo $longitude;?>" />
            <input type="hidden" name="subcat_id" id="subcat_id" value="<?php echo $getSubcatName['id'];?>" />
            <div class="ad-classified">
              <ul>
                <li>
                  <label>Category *</label>
                  <div class="choose_cat">
                    <div id="category" class="fields"> <span><?php echo $getCatName['catname'];?> &gt; <?php echo $getSubcatName['catname']; ?></span> <a style="cursor: pointer;" name="goBackToSelection" id="goBackToSelection" href="<?php echo CreateLink(array("addpostcat")); ?>">Change the category</a> </div>
                  </div>
                </li>
                <li>
                  <label>Ad Title*</label>
                  <input name="name" type="text" value="" class="field_form" id="name" required>
                </li>
                <br/>
                <li>
                  <label>Ad Type*</label>
                  <select id="ad_type" name="ad_type" required="required" class="field_form">
                    <option value="">Select Ad Type</option>
                    <option value="0">Free</option>
                    <option value="1">Paid</option>
                  </select>
                </li>
                <div id="0" class="colors" style="display:none;"></div>
                
           <div id="row_dim">
                <div id="1" class="colors" style="display:none;">
                  <li>
                   <label>Select Package</label>
                   <div class="package_css">
                    <?php foreach($pack as $packs) { ?>
                   
                    <input type="radio" class="prop" name="package_id" value="<?php echo $packs['id'];?>" id="package_id">
                    <?php echo $packs['package_name'];?>-- $ <?php echo $packs['package_prices'];?> / <?php echo $packs['package_duration'];?> <br>
                    <?php } ?>
                    </div></div>
                  </li>
                </div>
              </ul>
            </div>
            <div class="ad-classified">
              <ul>
                <li>
                  <label>Price</label>
                  <div class="input_price">
                    <input value="1" name="opt_price" id="opt_price"  type="radio" required="required">
                    AUD
                    <input type="text" name="price" class="1" disabled="true" required="required"/>
                  </div>
                </li>
                <div class="input_price2">
                  <li>
                    <input value="2" name="opt_price" id="opt_price" type="radio" required="required">
                    Free </li>
                  <li>
                    <input value="3" name="opt_price" id="opt_price" type="radio" required="required">
                    Please contact </li>
                  <li>
                    <input value="4" name="opt_price" id="opt_price" type="radio" required="required">
                    Swap / Trade </li>
                </div>
              </ul>
            </div>
            <div class="ad_details">
              <ul>
                <li>
                  <label>Description</label>
                  <textarea name="logn_desc" cols="" rows="" id="logn_desc" class="field_form_area" required="required"></textarea>
                </li>
                <li>
                  <label>Select Location</label>
                  <select name="location" id="location" onchange="setEmirate(this.value);" class="field_form" required="required">
                    <option value="">Select Location</option>
                    <?php foreach ($locobj1 as $location){?>
                    <option value="<?php echo $location['id'];?>"><?php echo  $location['name']; ?></option>
                    <?php } ?>
                  </select>
                </li>
                <li>
                  <label>Zip</label>
                  <input  name="zip" id="zip" type="text" class="field_form" required>
                </li>
              </ul>
            </div>
            <div class="update-photo">
              <div class="fieldset_box" id="AddFileInputBox">
                <ul>
                  <li>
                    <label>Upload Photos</label>
                    <div class="photo">
                      <input type="file" name="image[]" id="image[]" value="Add Photos"  class="category" />
                      <span style="display:inline;"  class="tip">(Allowed file formats : jpg/gif/png) <br />
                      (Allowed image size : 15KB - 1MB)<br />
                      (Maximum : 5 Photos).</span>
                      <div class="more"><img src="<?php echo TemplateUrl();?>images/addmore.png" id="moremenu_manish1"  onclick="myFunction()" /></div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="ad-classified_video">
              <ul>
                <li>
                  <label>Video </label>
                  <input name="video" type="text" value="" class="field_form" id="video">
                  <br />
                  <span>Copy the embed tag of the video</span> </li>
                <li>
                  <label>Email * </label>
                  <input name="sell_email" type="email" value="<?php echo $_SESSION['FRONTUSER']['email'];?>" class="field_form" id="sell_email" required>
                  <br />
                  <span>Your email address will not be shared with others</span> </li>
                <li>
                  <label>Enter Below Code*</label>
                  <input name="6_letters_code" type="text" id="6_letters_code" class="field_form" required>
                  <br >
                  <img src="<?php echo SITEURL;?>/itf_ajax/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'> <span> Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</span> </li>
                <li>
                  <label>&nbsp </label>
                  <input name="submit" type="submit" value="Submit ad" class="pink">
                  <br/>
                  <span> By posting your ad, you're agreeing to our <a href="#">terms of use</a>.</span> </li>
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

    $(function() {
        $('#ad_type').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
			
        });
    });
	
	$(function() {
    $('#row_dim').hide(); 
    $('#ad_type').change(function(){
        if($('#ad_type').val() == '1') {
			//$("input[type='radio']").prop('required',true);
			$('#row_dim').show().removeClass("current_div"); 
			$('#package_id').prop('required',true);
        } else {
            $('#row_dim').addClass("current_div");
			$('#package_id').removeAttr('required');
        } 
    });
});
</script> 
