<?php
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$obj->admin_update($_POST);
		flash("Content is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$obj->admin_add($_POST);
		flash("Content is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $obj->CheckNewsletter($ids);
//include(BASEPATHS."/fckeditor/fckeditor.php")
include(BASEPATHS."/ckeditor/ckeditor.php");
?>

<script type="text/javascript">

$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {
           
			title: "required",
            message: "required"
			
        },
		messages: {
            title: "required",
            message: "required"
		}
    });
});
</script>
<div class="full_w">
	<!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
    <!-- Page Heading -->
					
<form action="" method="post" name="itffrminput" id="itffrminput">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />


    <div class="element">
        <label>Newsletter Title<span class="red">(required)</span></label>
        <input class="text"  name="title" type="text"  id="title" size="35" value="<?php echo isset($ItfInfoData['title'])?$ItfInfoData['title']:'' ?>" />
    </div>


    <div class="element">
        <label>Message</label>
              <textarea class="ckeditor" name="message"><?php echo isset($ItfInfoData['message'])?$ItfInfoData['message']:'' ?></textarea>

         <?php
       //     $oFCKeditor = new FCKeditor('message');
//                $oFCKeditor->BasePath =ITFPATH.'fckeditor/';
//                $oFCKeditor->Value =isset($ItfInfoData['message'])?$ItfInfoData['message']:'';
//                $oFCKeditor->Height="400";
//                $oFCKeditor->Width="600";
//                $oFCKeditor->ToolbarSet = 'ITFCustom';
//                $oFCKeditor->Create() ;
	  ?>
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