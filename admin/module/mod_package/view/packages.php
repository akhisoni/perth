<?php
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$packageobj->admin_update($_POST);
		flash("Package is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$packageobj->admin_add($_POST);
		flash("Package is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $packageobj->CheckPackage($ids);
include(BASEPATHS."/fckeditor/fckeditor.php")
?>
<script type="text/javascript">
$(document).ready(function() {
    var Validator = jQuery('#itffrminput').validate({
        rules: {
			package_name: "required",
			package_duration: "required",
			package_prices: "required",
			description: "required",
        },
		messages: {
			package_name: " Please enter package name .",
			package_duration: " Please enter package duration.",
			package_prices: " Please enter package prices.",
         description: " Please enter package description.",
		}
    });
});
</script>
<div class="full_w">
					<!-- Box Head -->
					<div class="h_title">  <?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?>	</div>
					<!-- End Box Head -->
<form action="" method="post" name="itffrminput" id="itffrminput">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Package Name <span>*</span></label>
	<input class="text"  name="package_name" type="text"  id="name" size="35" value="<?php echo isset($ItfInfoData['package_name'])?$ItfInfoData['package_name']:'' ?>" />	
</div>
 
  <div class="element">
	<span class="req">&nbsp;</span>
	<label>Package Duration<span>*</span></label>
	<input class="text"  name="package_duration" type="text"  id="name" size="35" value="<?php echo isset($ItfInfoData['package_duration'])?$ItfInfoData['package_duration']:'' ?>" />	
</div>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Package Prices</label>
<input class="text" name="package_prices" type="text"  id="package_prices" size="35" value="<?php echo isset($ItfInfoData['package_prices'])?$ItfInfoData['package_prices']:'' ?>" />		
</div>
 
 
 
 

 

 





 <div class="element">
<!-- End Form -->
<!-- Form Buttons -->
   <div class="entry">
	   <button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
</div>
</div>
<!-- End Form Buttons -->
</form>
</div>