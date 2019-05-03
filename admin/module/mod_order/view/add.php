<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$objReport->admin_updateReport($_POST);
		flash("Enquiry is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$objReport->admin_addReport($_POST);
		flash("Enquiry is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $objReport->CheckEnquiries($ids);
$InfoData1 = explode(',',$InfoData['upload']);
$stateobj = new State();
$stateobj1= $stateobj->getAllStateFront();
$categoryobj = new Category();
$categories = $categoryobj->showCategoriesList(0);
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#frmcategory").validate({
	rules: {
			name: "required"
		},
		messages: {
			name: "Please enter advertise name"
			}
	});
});
</script>
<div class="full_w">
					 <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
		<form name="frmcategory" id="frmcategory" method="post" action="" enctype="multipart/form-data">
		<input name="id" type="hidden" id="id" value="<?php echo !empty($InfoData['id'])?$InfoData['id']:''; ?>" />
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Name</label>
	<input class="text" readonly="readonly"  name="name" type="text"  id="name" size="35" value="<?php echo isset($InfoData['name'])?$InfoData['name']:'' ?>" />	
</div>


<div class="element">
	<span class="req">&nbsp;</span>
	<label>Email id <span>*</span></label>
	<input class="text" readonly="readonly" name="email" type="text"  id="email" size="35" value="<?php echo isset($InfoData['email'])?$InfoData['email']:'' ?>" />	
</div>
<div class="element">
	<span class="req">&nbsp;</span>
	<label>Description<span>*</span></label>
	<textarea name="description" readonly="readonly" class="textarea"><?php echo isset($InfoData['description'])?$InfoData['description']:'' ?></textarea>
</div>


<div class="element">
	<span class="req">&nbsp;</span>
	<label>Product URL<span>*</span></label>
	<input class="text"  name="producturl" type="text"  readonly="readonly" id="producturl" size="35" value="<?php echo isset($InfoData['producturl'])?$InfoData['producturl']:'' ?>" />	
</div>
<div class="element">
	<span class="req">&nbsp;</span>
	<label>Date<span>*</span></label>
	<input class="field size1"  name="date_added" type="text"  id="date_added" size="35" value="<?php echo isset($InfoData['date_added'])?$InfoData['date_added']:'' ?>" />	
</div>
<div class="entry">
<!--	<button type="submit">Submit</button>-->
        <button type="button" onclick="history.back()">Back</button>
</div>
</form>		
</div>