<?php
ini_set('max_execution_time', 1000000);
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$obj->admin_update($_POST);
		flash("Product is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$obj->admin_add($_POST);
		flash("Product is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $obj->CheckProduct($ids);
$categoryobj = new Category();
$categories = $categoryobj->getAllActiveCat(0);
$subcats = $categoryobj->showCategoriesList();
$stateobj = new State();
$state = $stateobj->getAllStateFront();
$userobj = new User();
$itfUserdata = $userobj->ShowAllSupplierAdmin();
include(BASEPATHS."/fckeditor/fckeditor.php")
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
	
function setSubcategory($id)
{

$.ajax({
url:"itf_ajax/subcategory.php",
data:"category="+$id,
success:function(itfmsg){$("#categoryoption").html(itfmsg);}
});
}




</script>
<script type="text/javascript">

$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {           
                pname: "required",
				 price: "required",
                category_id:"required",
                code: "required",
              //  logn_desc: "required"<?php if($ids==""){ ?>,
                //main_image: "required"
				  seller_id:"required"
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
        <select name="category_id" class="err" onchange="setSubcategory(this.value);">
            <option value="">-- select category --</option>
            <?php foreach($categories as $cat) {?>
                <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $ItfInfoData["category_id"]){ echo"selected";} ?>><?php echo $cat['catname']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="element">
  <span id="categoryoption"> <select name="subcat_id"  class="field size1">
          <?php foreach($subcats as $key=>$cat) {?>
                <option value="<?php echo $key; ?>" <?php if($key == $ItfInfoData["subcat_id"]){ echo"selected";} ?>><?php echo $cat; ?></option>
            <?php } ?>
        
        </select></span>
        </div>
<!--    <div class="element">
        <label>Code <span class="red">(required)</span></label>
        <input class="text"  name="code" type="text"  size="35" value="<?php echo isset($ItfInfoData['code'])?$ItfInfoData['code']:'' ?>" />
    </div>-->

    <div class="element">
        <label>Name <span class="red">(required)</span></label>
        <input class="text"  name="pname" type="text" size="35" value="<?php echo isset($ItfInfoData['pname'])?$ItfInfoData['pname']:'' ?>"  required="required"/>
    </div>
    
      <div class="element">
        <label>Slug URL Name </label>
        <input class="text"  name="slug" type="text"  id="slug" size="35" value="<?php echo isset($ItfInfoData['slug'])?$ItfInfoData['slug']:'' ?>" />
    </div>
    
      <div class="element">
        <label> Price <span class="red">(required)</span></label>
       <input class="text"  name="price" type="text"  id="price" size="35" value="<?php echo isset($ItfInfoData['price'])?$ItfInfoData['price']:'' ?>" required="required"/>
  </div>
    
   <div class="element">
        <label> GST Tax <span class="red">(required)</span></label>
       <input class="text"  name="gst_tax" type="text"  id="gst_tax" size="35" value="18" required="required"/>
  </div>
    
 
       <!--<div class="element">
 
        <label>Image </label>
 <div id="FileUpload">
    <input type="file" size="24" id="main_image" name="main_image" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('bannerimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	      
      </div>-->
   

    <!--<div class="element">
        <label>Catalogue Gallery Images<span class="blue">(one or more than one)</span> </label>
        <input class="text" name="image[]" type="file"  id="image" size="35" multiple />
    </div>-->

   <!-- <div class="element">
        <label>Description <span class="red">(required)</span></label>
        <textarea class="textarea" name="logn_desc"><?php echo isset($ItfInfoData['logn_desc'])?$ItfInfoData['logn_desc']:'' ?></textarea>

    </div>
-->
    


      <!--  <div class="element">
        <label>Seller Email Id <span>*</span></label>
        <input class="text"  name="sell_email" type="text"  id="sell_email" size="35" value="<?php echo isset($ItfInfoData['sell_email'])?ucwords($ItfInfoData['sell_email']):'' ?>" />	
        </div>  
       -->
        
          <div class="element">
        <label>Vendor Name</label>
       <select name="seller_id" id="seller_id" required>
      <option value="">--Select Vendor--</option>       
       <?php foreach($itfUserdata as $itfUser) {?>
       <option value="<?php echo $itfUser['id'];?>"<?php if($ItfInfoData["seller_id"] == $itfUser['id']){ echo"selected";} ?>><?php echo $itfUser['name'];?> (<?php echo $itfUser['company_name'];?>)</option>
       <?php } ?>
       </select>
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