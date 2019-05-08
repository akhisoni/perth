<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$objbanner->admin_updateBanner($_POST);
		flash("Banner is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$objbanner->admin_addBanner($_POST);
		flash("Banner is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $objbanner->CheckBanner($ids);
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#frmcategory").validate({
	rules: {
			name: "required"
		},
		messages: {
			name: "Please enter banner name"
			}
	});
});
</script>
<div class="full_w">
					 <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
		<form name="frmcategory" id="frmcategory" method="post" action="" enctype="multipart/form-data">
		<input name="id" type="hidden" id="id" value="<?php echo !empty($InfoData['id'])?$InfoData['id']:''; ?>" />
 <?php if(!empty($InfoData['id'])){ ?>
        <img src="<?php echo PUBLICPATH."website_banner/".$InfoData['imagename']; ?>" width="225" height="225"  />   <?php }?>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Banner Title <span>*</span></label>
	<input class="text"  name="banner_title" type="text"  id="banner_title" size="35" value="<?php echo isset($InfoData['banner_title'])?$InfoData['banner_title']:'' ?>" />	
</div>

 <div class="element">
	<span class="req">&nbsp;</span>
	<label> Banner Description </label>
            <textarea class="textarea" name="banner_desc" type="text"  id="banner_desc"><?php echo isset($InfoData['banner_desc'])?$InfoData['banner_desc']:'' ?></textarea>

</div>
            
 <div class="element">
 <span class="req">&nbsp;</span>
	<label>Banner Image <span>*</span></label>
	
<div id="FileUpload">
    <input type="file" size="24" id="bannerimage" name="bannerimage" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('bannerimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	
</div>

 <div class="element">
	
	<label>Banner URL <span>*</span></label>
	<input class="text"  name="url" type="text"  id="name" size="35" value="<?php echo isset($InfoData['url'])?$InfoData['url']:'' ?>" />	
</div>
            
             <div class="element">
	
	<label>Banner Button Name <span>*</span></label>
	<input class="text"  name="banner_button_title" type="text"  id="banner_button_title" size="35" value="<?php echo isset($InfoData['banner_button_title'])?$InfoData['banner_button_title']:'' ?>" />	
</div>
<div class="entry">
	<button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
</div>
</form>		
</div>