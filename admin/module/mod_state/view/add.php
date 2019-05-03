<?php
if(isset($_POST['id']))
{
	$userids = $_POST['id'];
	if(!empty($_POST['id']))
	{
		$obj->admin_updateState($_POST);
		flash($pagetitle." is successfully Updated");
	}
	else
	{
		$obj->admin_addState($_POST);
		flash($pagetitle." is successfully added");
	}
	
	$urlname = CreateLinkAdmin(array($currentpagenames,"parentid"=>$parentids));
	redirectUrl($urlname);
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$InfoData = $obj->CheckState($ids);

?>
<script type="text/javascript">
$(document).ready(function() {
	$("#itffrminput").validate({
	rules: {
			name: "required"
		},
		messages: {
			name: "Please enter <?php echo $pagetitle; ?> name"
			}
	});
});
</script>



<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
    <!-- Page Heading -->

    <form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
        <input name="id" type="hidden" id="id" value="<?php echo !empty($InfoData['id'])?$InfoData['id']:''; ?>" />
        <input name="parentid" type="hidden" id="parentid" value="<?php echo $parentids; ?>" />


        <div class="element">
            <label><?php echo $pagetitle; ?> Name<span class="red">(required)</span></label>
            <input class="field size1"  name="name" type="text"  id="name" size="35" value="<?php echo isset($InfoData['name'])?$InfoData['name']:'' ?>" />
        </div>


<div class="element">
            <label>Latitude </label>
            <input class="field size1"  name="lat" type="text"  id="lat" size="35" value="<?php echo isset($InfoData['lat'])?$InfoData['lat']:'' ?>" />
        </div>



<div class="element">
            <label>Longitude </label>
            <input class="field size1"  name="lon" type="text"  id="lon" size="35" value="<?php echo isset($InfoData['lon'])?$InfoData['lon']:'' ?>" />
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