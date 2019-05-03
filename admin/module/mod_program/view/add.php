<script type="text/javascript">
$(document).ready(function() {
	$("#frmcategory").validate({
	rules: {
			catname: "required"
		},
		messages: {
			catname: "Please enter category name"
			}
	});
});
</script>
<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$objmodule->adminUpdate($_POST);
		flash("Detail is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$objmodule->adminAdd($_POST);
		flash("Detail is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $objmodule->showAll();
?>
<div class="full_w">
  <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>

		<form name="frmcategory" id="frmcategory" method="post" action="" enctype="multipart/form-data">
		<input name="id" type="hidden" id="id" value="<?php echo !empty($InfoData['id'])?$InfoData['id']:''; ?>" />

	    <div class="element">
	<label>Paypal Type <span>*</span></label>
    <input class="text"  name="paypal_type" type="text"  id="paypal_type" size="35" value="<?php echo isset($InfoData['paypal_type'])?$InfoData['paypal_type']:'' ?>" required="required"/>	
</div>		
	
	
 <div class="element">
	<label>Paypal Email Id <span>*</span></label>
	<input class="text"  name="paypal_email" type="text"  id="paypal_email" size="35" value="<?php echo isset($InfoData['paypal_email'])?$InfoData['paypal_email']:'' ?>" />	
</div>

 <div class="element">
	<label>Paypal Api Username <span>*</span></label>
	<input class="text"  name="api_username" type="text"  id="api_username" size="35" value="<?php echo isset($InfoData['api_username'])?$InfoData['api_username']:'' ?>" required="required" />	
</div>

<div class="element">
	<label>Paypal Api Password <span>*</span></label>
	<input class="text"  name="api_password" type="text"  id="api_password" size="35" value="<?php echo isset($InfoData['api_password'])?$InfoData['api_password']:'' ?>" required="required" />	
</div>


<div class="element">
	<label>Paypal Api Secret <span>*</span></label>
	<input class="text"  name="api_secret" type="text"  id="api_secret" size="35" value="<?php echo isset($InfoData['api_secret'])?$InfoData['api_secret']:'' ?>" required="required"/>	
</div>

<div class="entry">
	<button type="submit">Submit</button>
	 
</div>


</form>		
</div>
