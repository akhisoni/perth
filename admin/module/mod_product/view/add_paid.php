<?php
ini_set('max_execution_time', 1000000);
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$obj->admin_update($_POST);
		flash("Ad is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$obj->admin_add($_POST);
		flash("Ad is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $obj->CheckProductPaid($ids);
$categoryobj = new Category();
$categories = $categoryobj->showCategoriesList($ItfInfoData['category_id']);
$stateobj = new State();
$state = $stateobj->getAllStateFront();
$userobj = new User();
$itfUserdata = $userobj->ShowAllSupplierAdmin();
include(BASEPATHS."/fckeditor/fckeditor.php");

$package= new Package();
$packs = $package->ShowAllPackageFrontUnique($ItfInfoData['package_id']);

?>
<script>

function myFunction()
{
	
	

	var FileInputsHolder 	= $('#AddFileInputBox');

	var MaxFileInputs		= 5; //Maximum number of file input boxs

	var i = $('#AddFileInputBox .multifileblock').size() + 1;

	

		if(i < MaxFileInputs)

			{

		$('<div class="ffg"><div class="multifileblock"><div class="addmorefiles"><input type="file" id="fileInputBox" size="20" name="image[]" class="addedInput"/></div><div class="smalladdmore"><img src="<?php echo TemplateUrl();?>images/close.png" border="0" onclick="AddMoreImagesClose()" id="removeFileBox" /></div><div class="clear"></div></div></div>').appendTo(FileInputsHolder);

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

</script>
<script type="text/javascript">

$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {           
                name: "required",
                category_id:"required",
                code: "required",
                logn_desc: "required"<?php if($ids==""){ ?>,
                main_image: "required"
				//  seller_id:"required"
                <?php } ?>
        },
        messages: {


        }
    });
});
</script>
<script>
    $(function () {
        $("#sell_name").hide();
        $('#new_client').click(function() {
            if( $(this).is(':checked')) {
                $("#sell_name").show();
                $("#user_id1").hide();
                $('#address').val("");

                $('#email').val("");
                $('#phone').val("");
            } else {
                $("#sell_name").hide();
                $("#user_id1").show();
            }
        }); 
    });
</script>

<div class="full_w">
	<!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
    <!-- Page Heading -->
					
<form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />

    <div class="element">
        <label>Category <span class="red">(required)</span></label>
        <select name="subcat_id" class="err">
            <option value="">-- select category --</option>
            <?php foreach($categories as $key=>$cat) {?>
                <option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["subcat_id"]){ echo"selected";} ?>><?php echo $cat; ?></option>
            <?php } ?>
        </select>
    </div>

<!--    <div class="element">
        <label>Code <span class="red">(required)</span></label>
        <input class="text"  name="code" type="text"  size="35" value="<?php echo isset($ItfInfoData['code'])?$ItfInfoData['code']:'' ?>" />
    </div>-->

    <div class="element">
        <label>Name <span class="red">(required)</span></label>
        <input class="text"  name="name" type="text" size="35" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>" />
    </div>
    
      <div class="element">
        <label> Price <span class="red">(required)</span></label>
         <input type="radio" name="opt_price" value="1" <?php if(1 == $ItfInfoData["opt_price"]){ echo "checked";} ?>> AUD <input class=""  name="price" type="text" size="25" value="<?php echo isset($ItfInfoData['price'])?$ItfInfoData['price']:'' ?>" /><br>
  <input type="radio" name="opt_price" value="2" <?php if(2 == $ItfInfoData["opt_price"]){ echo "checked";} ?>> Free <br>
  <input type="radio" name="opt_price" value="3" <?php if(3 == $ItfInfoData["opt_price"]){ echo "checked";} ?>> Please contact<br>
    <input type="radio" name="opt_price" value="4" <?php if(4 == $ItfInfoData["opt_price"]){ echo "checked";} ?>> Swap / Trade
  
  </div>
    
 
       <div class="element">
    <div class="fieldset_box" id="AddFileInputBox">
        <label>Image </label>
        <input type="file" name="image[]" id="image[]" value="Add Photos" class="ip4" required="required" />
        <div class="fieldset_box" style="margin-bottom:0px;">
          <label> &nbsp;</label>
          <div class="more"><img src="<?php echo TemplateUrl();?>images/addmore.png" id="moremenu_manish"  onclick="myFunction()" /></div>
          <span style="display: inline; position:absolute; right:125px; top:-50px;" class="tip">(Allowed file formats : jpg/gif/png) <br />
          (Allowed image size : 15KB - 1MB)<br />
          (Maximum : 5 Photos).</span> </div>
      </div>
      </div>
   

    <!--<div class="element">
        <label>Catalogue Gallery Images<span class="blue">(one or more than one)</span> </label>
        <input class="text" name="image[]" type="file"  id="image" size="35" multiple />
    </div>-->
     <div class="element">
        <label>Video <span class="blue"></span> </label>
        <textarea class="textarea" name="video"><?php echo isset($ItfInfoData['video'])?$ItfInfoData['video']:'' ?></textarea>
    </div>

    <div class="element">
        <label>Description <span class="red">(required)</span></label>
        <textarea class="textarea" name="logn_desc"><?php echo isset($ItfInfoData['logn_desc'])?$ItfInfoData['logn_desc']:'' ?></textarea>

    </div>
     <div class="element">
        <label>Location <span class="red">(required)</span></label>
        <select name="location" class="err">
            <option value="">-- select Location --</option>
            <?php foreach($state as $sat) {?>
                <option value="<?php echo $sat['id']; ?>" <?php if($sat['id'] == $ItfInfoData["location"]){ echo"selected";} ?>><?php echo $sat['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    
     <div class="element">
        <label> Zip <span class="red">(required)</span></label>
        <input class="text"  name="zip" type="text" size="35" value="<?php echo isset($ItfInfoData['zip'])?$ItfInfoData['zip']:'' ?>" />
    </div>


        <div class="element">
        <label>Seller Email Id <span>*</span></label>
        <input class="text"  name="sell_email" type="text"  id="sell_email" size="35" value="<?php echo isset($ItfInfoData['sell_email'])?ucwords($ItfInfoData['sell_email']):'' ?>" />	
        </div>  
       
       
        <div class="element">
        <label>Package Name<span>*</span></label>
        <input class="text"  name="payment_amount" type="text"  id="payment_amount" size="35" value="<?php echo $packs['package_name'];?>" />	
        </div>  
       
        
       
         <div class="element">
        <label>Package Amount<span>*</span></label>
        <input class="text"  name="payment_amount" type="text"  id="payment_amount" size="35" value="<?php echo isset($ItfInfoData['payment_amount'])?ucwords($ItfInfoData['payment_amount']):'' ?>" />	
        </div>  
       
        
          <div class="element">
        <label>Transaction Id<span>*</span></label>
        <input class="text"  name="txn_id" type="text"  id="txn_id" size="35" value="<?php echo isset($ItfInfoData['txn_id'])?ucwords($ItfInfoData['txn_id']):'' ?>" />	
        </div>  
       
   
        
        
<!-- Form Buttons -->
    <div class="entry">
        <button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
    </div>
<!-- End Form Buttons -->
</form>
    <!-- End Form -->
</div>