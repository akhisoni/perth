<?php 
$id = isset($_GET['id'])?$_GET['id']:'';
$prodobj = new Product();
$stateobj = new State();
$objreport = new Report();
$stateobj1 = $stateobj->getAllStateFront();
$objreport1 = $prodobj->showAllProductbyid($id);
$imge = unserialize($objreport1['image']);
if(isset($_POST['id']))
{
	
if(!empty($_POST['id']))
{
$prodobj->admin_update($_POST);
flashMsg("You have successfully update the Ad");
redirectUrl(CreateLink(array('customer', 'mode'=>'details','id'=>$id)));
}}
?>
<script>

function myFunction()
{
	
	

	var FileInputsHolder 	= $('#AddFileInputBox');

	var MaxFileInputs		= 5; //Maximum number of file input boxs

	var i = $('#AddFileInputBox .multifileblock').size() + 1;

	

		if(i < MaxFileInputs)

			{

		$('<div class="ffg"><div class="multifileblock"><div class="addmorefiles"><input type="file" id="fileInputBox" size="20" name="image[]" class="addedInput"/><div class="smalladdmore"><img src="<?php echo TemplateUrl();?>images/close_icon.png" border="0" onclick="AddMoreImagesClose()" id="removeFileBox" /></div><div class="clear"></div></div></div></div>').appendTo(FileInputsHolder);

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



</script>

    <div class="buying_request">
      <div class="main-classified">
            <form class="form_field_post" action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
              <input type="hidden" name="id" id="id" value="<?php echo $objreport1['id'];?>" />
             <input value="<?php echo $_SESSION['FRONTUSER']['id'];?>" name="seller_id" id="seller_id"  type="hidden" >
              <input type="hidden" name="category_id" id="category_id" value="<?php echo $objreport1['category_id'];?>" />
              <div class="ad-classified">
                <ul>
                 
                  <li>
                    <label>Ad Title*</label>
                    <input name="name" type="text" value="<?php echo $objreport1['name'];?>" class="field_form" id="name" required="required">
                  </li>
                  </ul></div>
                  <div class="ad-classified">
                  <ul>
                 
                  
                 <li>
                  <label>Price</label>
                  <div class="input_price">
                      <input value="<?php echo $objreport1['opt_price'];?>" name="opt_price" id="opt_price"  type="radio" >
                    AUD
                           <input type="text" name="price" class="1" value="<?php echo $objreport1['price'];?>"/></div>
                  </li>
  <div class="input_price2">
                  <li>
                    <input value="<?php echo $objreport1['opt_price'];?>" name="opt_price" id="opt_price" type="radio">
                   Free
                  </li>
                  <li>
                    <input value="<?php echo $objreport1['opt_price'];?>" name="opt_price" id="opt_price" type="radio">
                    Please contact
                  </li>
                  <li>
                    <input value="<?php echo $objreport1['opt_price'];?>" name="opt_price" id="opt_price" type="radio">
                   Swap / Trade
                  </li></div>
                  
      
                      
                  </ul></div>
                  <div class="ad_details">
                  <ul>
                  <li>
                    <label>Description</label>
                    <textarea name="logn_desc" cols="" rows="" id="logn_desc" class="field_form_area"><?php echo $objreport1['logn_desc'];?></textarea>
                  </li>
                  <li>
                    <label>Select Location</label>
                    <select name="location" id="location" onchange="setEmirate(this.value);" class="field_form">
                      <option value="">Select Location</option>
                      <?php foreach ($stateobj1 as $location){?>
                      <option value="<?php echo $location['id'];?>"  <?php if($objreport1['location']==$location['id']){ echo"selected"; } ?>><?php echo  $location['name']; ?></option>
                      <?php } ?>
                    </select>
                  </li>
                  <li>
                    <label>Zip</label>
                    <input  name="zip" id="zip" type="text" class="field_form" value="<?php echo $objreport1['zip'];?>">
                  </li>
                </ul>
              </div>
              <div class="update-photo">
                <div class="fieldset_box" id="AddFileInputBox">
                  <ul>
                    <li>
                      <label>Upload Photos</label>
                   
                      <div class="photo">
                        <input type="file" name="image[]" id="image[]" value="Add Photos"  class="category" />
                        <span style="display:inline;"  class="tip">(Allowed file formats : jpg/gif/png) <br />
                        (Allowed image size : 15KB - 1MB)<br />
                        (Maximum : 5 Photos).</span>
                        <div class="more"><img src="<?php echo TemplateUrl();?>images/addmore.png" id="moremenu_manish1"  onclick="myFunction()" /></div>
                        <?php foreach($imge as $imagevalue){?>
<li><a rel="<?php echo $imagevalue; ?>"><img src="<?php echo PUBLICPATH."products/".$imagevalue; ?>" width="50px;" height="50px;" /></a></li>  
<?php } ?>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="ad-classified_video">
                <ul>
                  <li>
                    <label>Video </label>
                    <input name="video" type="text" value="<?php echo $objreport1['video'];?>" class="field_form" id="video">
                   <br /> <span>Copy the embed tag of the video</span> </li>
                  <li>
                    <label>Email * </label>
                    <input name="sell_email" type="email" value="<?php echo $objreport1['sell_email'];?>" class="field_form" id="sell_email" required="required" >
                   <br /> <span>Your email address will not be shared with others</span> </li>
                    
                  
                 <li>
                    <label>&nbsp </label>
                    <input name="submit" type="submit" value="Submit ad" class="pink">
                    <br/><span> By posting your ad, you're agreeing to our <a href="#">terms of use</a>.</span>
                  </li>
                  <li>
                </ul>
              </div>
            </form>
          </div>
    </div>
