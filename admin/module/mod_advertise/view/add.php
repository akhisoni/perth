<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$categoryobj->admin_updateAdvertise($_POST);
		flash("Advertise is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$categoryobj->admin_addAdvertise($_POST);
		flash("Advertise is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $categoryobj->CheckAdvertise($ids);
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
 <?php if(!empty($InfoData['id'])){ ?>
        <img src="<?php echo PUBLICPATH."advertise/".$InfoData['imagename']; ?>" width="225" height="225"  />   <?php }?>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Advertise Name <span>*</span></label>
	<input class="field size1"  name="name" type="text"  id="name" size="35" value="<?php echo isset($InfoData['name'])?$InfoData['name']:'' ?>" />	
</div>

 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Advertise URL </label>
	<input class="field size1"  name="urllink" type="text"  id="urllink" size="35" value="<?php echo isset($InfoData['urllink'])?$InfoData['urllink']:'' ?>" />	
</div>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Advertise Image <span>*</span></label>
	<div id="FileUpload">
    <input type="file" size="24" id="bannerimage" name="bannerimage" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('bannerimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	

</div>

<div class="entry">
	<button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
</div>
</form>		
</div>