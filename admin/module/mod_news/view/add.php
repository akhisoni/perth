<?php
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$cmsobj->admin_update($_POST);
		flash("Content is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$cmsobj->admin_add($_POST);
		flash("Content is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $cmsobj->CheckPageCms($ids);
//include(BASEPATHS."/fckeditor/fckeditor.php");
include(BASEPATHS."/ckeditor/ckeditor.php");


?>

<script type="text/javascript">
function load(){
  window.document.designMode = "On";
}
function load(){
  getIFrameDocument("editorWindow").designMode = "On";
}

$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {
           
			name: "required",
			pagetitle: "required",
			description: "required",
			
        },
		messages: {
			

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
        <label>News Title<span class="red">(required)</span></label>
        <input class="text" name="pagetitle" type="text"  id="pagetitle" size="35" required="required" value="<?php echo isset($ItfInfoData['pagetitle'])?$ItfInfoData['pagetitle']:'' ?>" />
    </div>

    <div class="element">
        <label>Alias Name<span class="red">(required)</span></label>
        <input class="text"  name="name" type="text"  id="name" size="35" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>" />
    </div>

    <div class="element">
        <label>Keyword</label>
        <input class="text" name="pagekeywords" type="text"  id="pagekeywords" size="35" value="<?php echo isset($ItfInfoData['pagekeywords'])?$ItfInfoData['pagekeywords']:'' ?>" />
    </div>

    <div class="element">
        <label>Meta tag</label>
        <textarea class="textarea" name="pagemetatag" type="text"  id="pagemetatag"><?php echo isset($ItfInfoData['pagemetatag'])?$ItfInfoData['pagemetatag']:'' ?></textarea>
    </div>

     
       <div class="element">
 
        <label>Image </label>
 <div id="FileUpload">
    <input type="file" size="24" id="newsimage" name="newsimage" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('newsimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	      
      </div>
                                                              
                                                              
    <div class="element">
        <label>Description</label>
  
      <textarea class="ckeditor" name="description" required="required"><?php echo isset($ItfInfoData['description'])?$ItfInfoData['description']:''?></textarea>
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

