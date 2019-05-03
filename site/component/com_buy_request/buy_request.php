<script src="<?php echo TemplateUrl();?>js/jquery.validate.js"></script>
   <link rel="stylesheet" href="<?php echo TemplateUrl();?>css/chosen.css">
   
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
<?php 
$categoryobj = new Category();
$categories = $categoryobj->getAllCategoryFront(0);
$prodobj = new Product();
$stateobj = new State();
$stateobj1= $stateobj->getAllStateFront();
/*if(isset($_POST['submit']) && !empty($_POST['email'])){          
$prodobj->Add_Buying_Request($_POST);
flashMsg("You have successfully Placed a buying request");
redirectUrl(CreateLink(array("buy_request")));
}
*/

if(isset($_POST['submit'])){
$categoryArray = array();
$categoryArray = $_POST['catalog_category'];
//echo count($categoryArray); die;
/*if(count($categoryArray) >1) { 
$err = "catalog category required"; 
echo $err;
}*/
if(isset($_POST['submit']) && !empty($_POST['email']) && count($categoryArray) >1){          
$prodobj->Add_Buying_Request($_POST);
flashMsg("You have successfully Placed a buying request");
redirectUrl(CreateLink(array("buy_request"))); 
}else{
echo "Catalogue Category required";
}
}
$obj = new User();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
?>
<script type="text/javascript">

$(document).ready(function() {
//var field = new String($("#catalog_category").attr("name"));
   var Validator = jQuery('#custom').validate({

   
        rules: {
            
				name: {required:true,},
				last_name: {required:true,},
				post_code: {required:true,},
				description: {required:true,},
			/*	'catalog_category[]': {required:true,},*/
				email: {required:true, email:true, },
                       
           
        },
        messages: {
           
				email: {required: ""},
				last_name: {required: ""},
				post_code: {required: ""},
				description: {required: ""},
				/*'catalog_category[]': {required: ""},*/
				name: {required:""}
      

        }
    });


});
</script>
<script>

function myFunction()
{
	var FileInputsHolder 	= $('#AddFileInputBox');
	var MaxFileInputs		= 5; //Maximum number of file input boxs
	var i = $('#AddFileInputBox .multifileblock').size() + 1;
		if(i < MaxFileInputs)
			{

		$('<div class="ffg"><div class="multifileblock"><div class="addmorefiles"><input type="file" id="upload[]" size="20" name="upload[]" class="addedInput"/><img src="<?php echo TemplateUrl();?>image/close_icon.png" border="0" onclick="AddMoreImagesClose()" id="removeFileBox" /></div><div class="clear"></div></div></div>').appendTo(FileInputsHolder);

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

<section class="section">
  <div class="center_main">
    <div class="home">Home > <span>Place Buying Request</span></div>
    <?php include('category.php'); ?>
    <div class="main-about">
      <div class="about-one">
        <h1>Place Buying Request</h1>
        <img src="<?php echo TemplateUrl();?>image/line-sm.png"/> </div>
      <div class="Plucka_online">
        <div class="buying_request">
          <form id="custom" name="registration" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $userinfo['user_id'];?>" class="in-login">
            <ul>
             <li>To view your buying request offers, you do need to Register as a Buyer, it is Free and don’t worry we do protect your privacy</li>
              <li><span>*</span> Indicates required fields</li>
              <li>First Name <span>*</span></li>
              <li>
                <input type="text" name="name" value="<?php echo $userinfo['name'];?>" class="in-login">
              </li>
              <li>Last Name <span>*</span></li>
              <li>
                <input type="text" name="last_name" value="<?php echo $userinfo['last_name'];?>" class="in-login">
              </li>
              <li>Email Id <span>*</span></li>
              <li>
                <input type="text" name="email" value="<?php echo $userinfo['email'];?>" class="in-login">
              </li>
              <li>Company Name </li>
              <li>
                <input type="text" name="company_name" value="<?php echo $userinfo['company_name'];?>" class="in-login">
              </li>
              <li>Location <span>*</span></li>
              <li>
                <select name="location" class="in-login">
                  <?php foreach($stateobj1 as $stateobj2){?>
                  <option name="<?php echo $stateobj2['name'];?>"><?php echo $stateobj2['name'];?></option>
                  <?php } ?>
                </select>
              </li>
              <li>Post Code <span>*</span></li>
              <li>
                <input type="text" name="post_code" value="" class="in-login">
              </li>
              <li>Category <span>*</span></li>
              
              
              
              <li>  
          
          <select name="catalog_category[]" data-placeholder="Choose a Category..." class="chosen-select in-login err" multiple  id="catalog_category" tabindex="4">
            <option value=""></option>
                  <?php foreach($categories as $cat) {?>
                  <option value="<?php echo $cat['catname'] ?>"><?php echo $cat['catname'] ?></option>
                  <?php } ?>
          </select>
      </li>
              <!--<li>
                <select name="catalog_category[]" class="in-login err multiple" multiple="multiple">
                  <option value="">-- select category --</option>
                  <?php foreach($categories as $key=>$cat) {?>
                  <option value="<?php echo $cat ?>"><?php echo $cat; ?></option>
                  <?php } ?>
                </select>
              </li>-->
              <input type="hidden" name="category_id" value="<?php echo $cat['catname'] ?>" class="in-login">
              <li>Product Name</li>
              <li>
                <input type="text" name="catalog_name" value="" class="in-login">
              </li>
              <li>Enter Your Buying Request Details Here <span>*</span></li>
              <li>
                <textarea name="description" class="in-login_textarea"></textarea>
              </li>
              <li>Upload File </li>
              <li>
                  <div class="fieldset_box" id="AddFileInputBox">
                <input type="file" name="upload[]" id="upload[]" value="" class="in-login">
                <div class="fieldset_box" style="margin-bottom:0px;">

		  	<label> &nbsp;</label>
        <div class="more"><img src="<?php echo TemplateUrl();?>image/addmore.png" id="moremenu_manish"  onclick="myFunction()" /> <span class="tip">(Maximum : 5 Files).</span></div>
       

        </div>
        </div>
              </li>
              
            </ul>
            <div class="submit">
              <input type="submit" name="submit" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo TemplateUrl();?>js/chosen.jquery.js" type="text/javascript"></script>

  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  
