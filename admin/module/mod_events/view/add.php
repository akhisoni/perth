<?php
ini_set('max_execution_time', 1000000);
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$obj->admin_update($_POST);
		flash("Event is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$obj->admin_add($_POST);
		flash("Event is succesfully added");
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

include(BASEPATHS."/ckeditor/ckeditor.php");

?>
<script>
function load(){
  window.document.designMode = "On";
}
function load(){
  getIFrameDocument("editorWindow").designMode = "On";
}

    
function myFunction()
{
	var FileInputsHolder 	= $('#AddFileInputBox');
	var MaxFileInputs		= 5; //Maximum number of file input boxs
	var i = $('#AddFileInputBox .multifileblock').size() + 1;
		if(i < MaxFileInputs)
			{

		$('<div class="ffg"><div class="multifileblock"><div class="addmorefiles"><input type="file" id="fileInputBox" size="20" name="image[]" class="addedInput"/></div><div class="smalladdmore"><img src="imgs/delete.png" border="0" onclick="AddMoreImagesClose()" id="removeFileBox" /></div><div class="clear"></div></div></div>').appendTo(FileInputsHolder);
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
                event_name: "required",
				 online_price: "required",
                category_id:"required",
                code: "required",
              //  logn_desc: "required"<?php if($ids==""){ ?>,
                //main_image: "required"
				 // seller_id:"required"
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
        <select name="category_id" class="err" onchange="setSubcategory(this.value);" required>
            <option value="">-- select category --</option>
            <?php foreach($categories as $cat) {?>
                <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $ItfInfoData["category_id"]){ echo"selected";} ?>><?php echo $cat['catname']; ?></option>
            <?php } ?>
        </select>
    </div>
   <!-- <div class="element">
  <span id="categoryoption"> <select name="subcat_id"  class="field size1">
          <?php foreach($subcats as $key=>$cat) {?>
                <option value="<?php echo $key; ?>" <?php if($key == $ItfInfoData["subcat_id"]){ echo"selected";} ?>><?php echo $cat; ?></option>
            <?php } ?>
        
        </select></span>
        </div>-->
<!--    <div class="element">
        <label>Code <span class="red">(required)</span></label>
        <input class="text"  name="code" type="text"  size="35" value="<?php echo isset($ItfInfoData['code'])?$ItfInfoData['code']:'' ?>" />
    </div>-->

    <div class="element">
        <label>Name <span class="red">(required)</span></label>
        <input class="text"  name="event_name" type="text" size="35" value="<?php echo isset($ItfInfoData['event_name'])?$ItfInfoData['event_name']:'' ?>"  required="required"/>
    </div>
    
      <div class="element">
        <label>Slug URL Name </label>
        <input class="text"  name="slug" type="text"  id="slug" size="35" value="<?php echo isset($ItfInfoData['slug'])?$ItfInfoData['slug']:'' ?>" />
    </div>
    
      <div class="element">
        <label> Online Price <span class="red">(required)</span></label>
       <input class="text"  name="online_price" type="number"  id="online_price" size="35" value="<?php echo isset($ItfInfoData['online_price'])?$ItfInfoData['online_price']:'' ?>" required="required"/>
  </div>
    
     <div class="element">
        <label>Early Bird Price <span class="red">(required)</span></label>
       <input class="text"  name="early_price" type="number"  id="early_price" size="35" value="<?php echo isset($ItfInfoData['early_price'])?$ItfInfoData['early_price']:'' ?>"/>
  </div>
    
     <div class="element">
        <label>Offline Price <span class="red">(required)</span></label>
       <input class="text"  name="offline_price" type="number"  id="offline_price" size="35" value="<?php echo isset($ItfInfoData['offline_price'])?$ItfInfoData['offline_price']:'' ?>" />
  </div>
    
   <div class="element">
        <label> Start Date <span class="red">(required)</span></label>
     <div class='input-group date' id='datetimepicker2'>
    <input type='text' class="text" id="start_date" name="start_date" value="<?php echo isset($ItfInfoData['start_date'])?$ItfInfoData['start_date']:'' ?>" required="required"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
  </div>
    <div class="element">
        <label> End Date <span class="red">(required)</span></label>
     <div class='input-group date' id='datetimepicker3'>
    <input type='text' class="text" id="end_date" name="end_date" value="<?php echo isset($ItfInfoData['end_date'])?$ItfInfoData['end_date']:'' ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
  </div>
    
    
       <div class="element">
        <label> Start Time <span class="red">(required)</span></label>
     <div class='input-group date' id='datetimepicker4'>
    <input type='text' class="text" id="start_time" name="start_time" value="<?php echo isset($ItfInfoData['start_time'])?$ItfInfoData['start_time']:'' ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
  </div>
   <div class="element">
        <label> End Time <span class="red">(required)</span></label>
     <div class='input-group date' id='datetimepicker5'>
    <input type='text' class="text" id="end_time" name="end_time" value="<?php echo isset($ItfInfoData['end_time'])?$ItfInfoData['end_time']:'' ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
  </div>
 
 
       <!--<div class="element">
 
        <label>Image </label>
 <div id="FileUpload">
    <input type="file" size="24" id="main_image" name="main_image" class="BrowserHidden text" onchange="getElementById('tmp_bannerimage').value = getElementById('bannerimage').value;" />
    <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField" /></div>
</div>
	      
      </div>-->
    
    <div class="element">
 
        <label>Upload Event Pdf File in pdf format </label>
 <div id="FileUpload">
    <input type="file" size="24" id="pdf_upload" name="pdf_upload" class="BrowserHidden text" onchange="getElementById('pdf_upload').value = getElementById('pdf_upload').value;" /> <?php if($ItfInfoData['pdf_upload'])  { echo '<a href="'.PUBLICPATH."pdf_upload/".$ItfInfoData['pdf_upload'].'" download><span class="glyphicon glyphicon-download-alt" style="font-size:20px;color:#E14848"></span> Download Pdf</a>  ';}?>

     <div id="pdf_upload"><input type="hidden" id="pdf_upload" class="FileField" /></div>
</div>
	     
      </div>
   <div class="element">
 <label>Upload Image (Multiple images up to 5 ) </label>
 <div class="fieldset_box" id="AddFileInputBox">
                <input type="file" name="image[]" id="image[]" value="" class="in-login">
                <div class="fieldset_box" style="margin-bottom:0px;">

		  	<label> &nbsp;</label>
        <div class="more"><img src="imgs/addmore.png" id="moremenu_manish"  onclick="myFunction()" /> <span class="tip">(Maximum : 5 Files).</span></div>
       

        </div>
        </div>
    <?php
       
       $imge = explode(',',$ItfInfoData['image']);
        if($imge[0]){
       foreach($imge as $imgs)
       {
          ?>
      <span><a href="<?php echo PUBLICPATH."event_images/".$imgs; ?>" downlaod><img class="zoomq" src="<?php echo PUBLICPATH."event_images/".$imgs; ?>" height="40" width="40"/> </a></span>  
       <?php
           
       } }?>
    </div>
    <!--<div class="element">
        <label>Catalogue Gallery Images<span class="blue">(one or more than one)</span> </label>
        <input class="text" name="image[]" type="file"  id="image" size="35" multiple />
    </div>-->
    
    
    <div class="element">
        <label>Organisation</label>
        <input class="text"  name="organisation" type="text" id="organisation" size="35" value="<?php echo isset($ItfInfoData['organisation'])?$ItfInfoData['organisation']:'' ?>"  />
    </div>

    <div class="element">
        <label>Email Address</label>
        <input class="text"  name="emailid" type="text" id="emailid" size="35" value="<?php echo isset($ItfInfoData['emailid'])?$ItfInfoData['emailid']:'' ?>"  />
    </div>
    <div class="element">
        <label>Phone No</label>
        <input class="text"  name="phoneno" type="text" id="phoneno" size="35" value="<?php echo isset($ItfInfoData['phoneno'])?$ItfInfoData['phoneno']:'' ?>"  />
    </div>
    
    <div class="element">
        <label>Venue</label>
        <input class="text"  name="venue" type="text" id="venue" size="35" value="<?php echo isset($ItfInfoData['venue'])?$ItfInfoData['venue']:'' ?>"  />
    </div>
     <div class="element">
        <label>Address</label>
        <input class="text"  name="address" type="text" id="address" size="35" value="<?php echo isset($ItfInfoData['address'])?$ItfInfoData['address']:'' ?>"  />
    </div>
    
    <div class="element">
        <label>Website URL</label>
        <input class="text"  name="web_url" type="text" id="web_url" size="35" value="<?php echo isset($ItfInfoData['web_url'])?$ItfInfoData['web_url']:'' ?>"  />
    </div>
    <div class="element">
        <label>Facebook URL</label>
        <input class="text"  name="fb_url" type="text" id="fb_url" size="35" value="<?php echo isset($ItfInfoData['fb_url'])?$ItfInfoData['fb_url']:'' ?>"  />
    </div>
    
    <div class="element">
        <label>Description <span class="red">(required)</span></label>
        <textarea class="ckeditor" name="event_desc"><?php echo isset($ItfInfoData['event_desc'])?$ItfInfoData['event_desc']:'' ?></textarea>
    </div>

    


      <!--  <div class="element">
        <label>Seller Email Id <span>*</span></label>
        <input class="text"  name="sell_email" type="text"  id="sell_email" size="35" value="<?php echo isset($ItfInfoData['sell_email'])?ucwords($ItfInfoData['sell_email']):'' ?>" />	
        </div>  
       -->
        
          <div class="element">
        <label>Member Name</label>
       <select name="seller_id" id="seller_id">
      <option value="">--Select Member--</option>       
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



               
<style>.addmorefiles {
    float: left;
    margin-top: 10px;
}.smalladdmore {
    margin-top: 13px;
    float: left;
    margin-left: 10px;
}</style> 
        
        <script type="text/javascript">
            $(function () {
              

                
                $('#datetimepicker2').datetimepicker({
                format: 'Y-MM-DD',
                showClose: true,
                useCurrent: false,
                minDate: moment()
                    
            }).on('changeDate', function (selected) {
       var incrementDay = moment(new Date(e.date));
                incrementDay.add(1, 'days');
       $('#datetimepicker3').data('DateTimePicker').minDate(incrementDay);
                $(this).data("DateTimePicker").hide();
    });

            $('#datetimepicker3').datetimepicker({
                format: 'Y-MM-DD',
                showClose: true,
                 useCurrent: false,
                minDate: moment()
            }).on('dp.change', function (e) {
                var decrementDay = moment(new Date(e.date));
                decrementDay.subtract(1, 'days');
                $('#datetimepicker2').data('DateTimePicker').maxDate(decrementDay);
                 $(this).data("DateTimePicker").hide();
        });
             
                $('#datetimepicker4').datetimepicker({
                    format: 'HH:mm'
                });
                
                  $('#datetimepicker5').datetimepicker({
                    format: 'HH:mm'
                });
            });
        </script>
