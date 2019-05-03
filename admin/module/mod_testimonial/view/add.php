<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$categoryobj->admin_updateTestimonial($_POST);
		flash("Testimonial is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$categoryobj->admin_addTestimonial($_POST);
		flash("Testimonial is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $categoryobj->CheckTestimonial($ids);
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#frmcategory").validate({
	rules: {
			name: "required"
		},
		messages: {
			name: "Please enter testimonial name"
			}
	});
});
</script>
<div class="full_w">
					 <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
		<form name="frmcategory" id="frmcategory" method="post" action="" enctype="multipart/form-data">
		<input name="id" type="hidden" id="id" value="<?php echo !empty($InfoData['id'])?$InfoData['id']:''; ?>" />
 <?php if(!empty($InfoData['id'])){ ?>
        <img src="<?php echo PUBLICPATH."testimonial/".$InfoData['imagename']; ?>" width="225" height="225"  />   <?php }?>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Client Name <span>*</span></label>
	<input class="text"  name="name" type="text"  id="name" size="35" value="<?php echo isset($InfoData['name'])?$InfoData['name']:'' ?>" />	
</div>

<div class="element">
	<span class="req">&nbsp;</span>
	<label>Company Name <span>*</span></label>
	<input class="text"  name="com_name" type="text"  id="com_name" size="35" value="<?php echo isset($InfoData['com_name'])?$InfoData['com_name']:'' ?>" />	
</div>

 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Company URL </label>
	<input class="text"  name="urllink" type="text"  id="urllink" size="35" value="<?php echo isset($InfoData['urllink'])?$InfoData['urllink']:'' ?>" />	
</div>
 <div class="element">
	<span class="req">&nbsp;</span>
	<label>Client Image <span>*</span></label>
	<div id="FileUpload">
    <input type="file" size="24" id="bannerimage" name="bannerimage" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('bannerimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	

</div>

 <div class="element">
	<span class="req">&nbsp;</span>
	<label> Testimonial Description </label>
            <textarea class="textarea" name="testi_desc" type="text"  id="testi_desc"><?php echo isset($InfoData['testi_desc'])?$InfoData['testi_desc']:'' ?></textarea>

</div>

<div class="entry">
	<button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
</div>
</form>		
</div>