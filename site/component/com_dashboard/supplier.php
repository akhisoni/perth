<script src="<?php echo TemplateUrl();?>js/jquery.validate.js"></script>
<?php 
$categoryobj = new Category();
$proobj = new Product();
error_reporting(0);

if(empty($_SESSION['FRONTUSER']))
{
   redirectUrl(CreateLink(array("signin")));
}

$countries = $objsite->getCountries();

$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);

$category_ids = explode(",",$userinfo['product_group_id']);
//echo"<pre>";print_r($userinfo);die;
$serviceObj = new ServiceCategory();
$services = $serviceObj->getCategories();

$categoryObj = new Category();
$categories = $categoryObj->getCategories();

foreach($categories as $category)
{
    $cats[$category['id']] = $category['catname'];
}

$showCat = array();

foreach($category_ids as $ids){
    if (array_key_exists($ids, $cats)) {
        $showCat[$ids] = $cats[$ids];
        unset($cats[$ids]);
    }
}

$categoriesData = implode('","',$cats);
$categoriesdisplay = implode(', ',$cats);

$quote = new Quote();
$enquiries = $quote->getEnquiryByLocation($userinfo['city_id'],$userinfo['service_category']);
$bids = $quote->getBids();

$totalMoney = $quote->totalMoney();

$state = new State();
$areas = $state->getAllStateFront();


$finalizeData = $quote->getOrder();
$activeQuotes = $quote->getActiveQuoteByLocation($userinfo['city_id']);
$closedQuotes = $quote->getClosedQuoteByLocation($userinfo['city_id']);

if(isset($_POST['submit'])){

    if(!empty($_POST['emailid'])){
        if(!empty($_POST['change_password'])){
            $obj->ChangePasswordFront($_POST['change_password']);
        }

        $obj->front_user_update($_POST);
        flashMsg("Success: Your profile is modified.");
        redirectUrl(CreateLink(array("dashboard#tab8")));
    }

    
		if(isset($_POST['catname'])){
		
			if(!empty($_POST['id']))
			{ echo "update";
				$categoryobj->admin_updateCategory($_POST);
				flashMsg("Category is successfully Updated");
				redirectUrl(CreateLink(array("dashboard#tab3")));
			}
			else
			{echo "add";
		
				$categoryobj->admin_addCategory($_POST);
				flashMsg("Category is successfully added");
				redirectUrl(CreateLink(array("dashboard#tab3")));
			}
		}
	
  

    if(!empty($_POST['name'])){
		if(!empty($_POST['id']))
	{
		$proobj->admin_update($_POST);
		flash("Catalogue is succesfully updated");
	    redirectUrl(CreateLink(array("dashboard#tab9")));
	}
	else
	{
		$proobj->admin_add($_POST);
		flashmsg("Catalogue is succesfully added");
	    redirectUrl(CreateLink(array("dashboard#tab9")));
	}}

}


$ItfInfoData = $categoryobj->CheckCategory($ids);
$categories = $categoryobj->showCategoriesList(0);

?>
<script>

    // Wait until the DOM has loaded before querying the document
    $(document).ready(function(){


        $('ul.tabs').each(function(){
            // For each set of tabs, we want to keep track of
            // which tab is active and it's associated content
            var $active, $content, $links = $(this).find('a');

            // If the location.hash matches one of the links, use that as the active tab.
            // If no match is found, use the first link as the initial active tab.
            $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
            $active.addClass('active');
            $content = $($active.attr('href'));

            // Hide the remaining content
            $links.not($active).each(function () {
                $($(this).attr('href')).hide();
            });

            // Bind the click event handler
            $(this).on('click', 'a', function(e){
                // Make the old tab inactive.
                $active.removeClass('active');
                $content.hide();

                // Update the variables with the new link and content
                $active = $(this);
                $content = $($(this).attr('href'));

                // Make the tab active.
                $active.addClass('active');
                $content.show();

                // Prevent the anchor's default click action
                e.preventDefault();
            });
        });

        var activelink = location.hash+"1";
        if(activelink!="1")
        $(activelink).click();

    });


</script>
<script type="text/javascript">

    $(document).ready(function() {

        $.validator.addMethod("noSpace", function(value, element) {

            var resinfo = parseInt(value.indexOf(" "));

            if(resinfo == 0 && value !="") { return false; } else return true;

        }, "Space are not allowed as first string !");

        $('#info').validate({
            rules: {
                name:{required:true, maxlength:100, noSpace: true},
				 company_name:{required:true, maxlength:100, noSpace: true},
                last_name:{required:true, maxlength:100, noSpace: true},
                address:{required:true, maxlength:100, noSpace: true},
                change_password:{minlength:8, maxlength:20, noSpace: true},
                payment_type:"required"

            },
            messages: {
                name:{required:"You must fill in all of the fields !"},
                last_name: {required:"You must fill in all of the fields !"},
                address: {required:"You must fill in all of the fields !" },
                payment_type: "You must fill in all of the fields !",
                change_password:{ required: "You must fill in all of the fields !"}

            }
        });


    });
</script>

<section class="section">
<div class="center_main">
<div class="home"><a href="<?php echo SITEURL; ?>">Home</a> / <a href="<?php echo CreateLink(array('dashboard')); ?>"><span>Dashboard</span></a></div>
<div style="padding-top:25px;">
<ul class="tabs" style="border-bottom:2px #b6b6b6 solid;">
    <li><a class="#" href="#tab1" id="tab11">Dashboard</a></li>
    <li><a class="#" href="#tab8" id="tab81">My Profile</a></li>
<!--    <li><a class="" href="#tab2" id="tab21">My Money</a></li>-->
    <li><a class="" href="#tab3" id="tab31">Add Categories</a></li>
    <!--<li><a class="" href="#tab5" id="tab51">Browse Quotes</a></li>
    <li><a class="" href="#tab4" id="tab41">My Bids</a></li>
    <li><a class="" href="#tab6" id="tab61">Active Quote</a></li>
    <li><a class="" href="#tab7" id="tab71">Closed Quote</a></li>-->
    <li><a class="#" href="#tab9" id="tab91">Add Catalogue</a></li>
</ul>
<div style="display: block;" id="tab1">
    <div class="cont_info">
        <div class="summary">
            <div class="summary_lft">
                <div class="summary_lft_cont">
                    <p>Supplier Id:<span> <?php echo $userinfo['registration_id'];?></span></p>
                    <p>Member Since:<span> <?php echo date('d M Y',$userinfo['created_date']); ?></span></p><br>
                    <!--<p><b>Summary of bid requested:</b></p>
                    <p>Total Bids:<span><?php echo count($bids); ?></span></p>
                    <p>Total Bids Won:<span><?php echo count($activeQuotes) + count($closedQuotes); ?></span></p>-->
                </div>
            </div>
            <div class="summary_rgt">
                <div class="map">
                    <?php
                    if(isset($userinfo['address']) && !empty($userinfo['address'])){
                        $myaddress = urlencode($userinfo['address']);
                        //here is the google api url
                        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$myaddress&sensor=false";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $getmap = curl_exec($ch);
                        curl_close($ch);

                        $googlemap = json_decode($getmap);
                        //get the latitute, longitude from the json result by doing a for loop
                        foreach($googlemap->results as $res){
                            $address = $res->geometry;
                            $latlng = $address->location;
                            $formattedaddress = $res->formatted_address;

                            ?>
                            <iframe class="map" width="447" height="257" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $myaddress;?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo urlencode($formattedaddress);?>&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                        <?php
                            break;
                        }
                    }else {?>
                        <img src="<?php echo IMAGEPATH.'map-not-available_lg.gif';?>" width="447" height="257" >

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>
<div style="display: block;" id="tab8">
    <div class="cont_info">
        <h3>Contact Information</h3>
        <form id="info" name="profile" method="post" action="<?php echo CreateLink(array('dashboard')); ?> " enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
            <div class="sec">
                <label>First Name <span class="required">*</span></label>
                <input name="name" type="text" value="<?php echo isset($userinfo['name'])?$userinfo['name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Last Name <span class="required">*</span></label>
                <input name="last_name" type="text" value="<?php echo isset($userinfo['last_name'])?$userinfo['last_name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Email ID <span class="required">*</span></label>
                <input name="emailid" type="text" readonly  value="<?php echo isset($userinfo['email'])?$userinfo['email']:''; ?>">
                <div class="clear"></div>
            </div>
             <div class="sec">
                <label>Company Name <span class="required">*</span></label>
                <input name="company_name" type="text"  value="<?php echo isset($userinfo['company_name'])?$userinfo['company_name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Change Password - to change the current password.</label>
                <input name="change_password" type="password" value="">
                <div class="clear"></div>
            </div>
            <!--<div class="sec">
                <label>Location<span class="required"> *</span></label>
                     <select class="sect_category" name="serviceArea[]" id="servicecategory" multiple>
            <?php foreach($areas as $area){  $city_ids = explode(",",$userinfo['city_id']);?>

                         <option value="<?php echo $area['id']; ?>" <?php if(in_array($area['id'],$city_ids)){ echo "selected"; } ?>><?php echo $area['name']; ?></option>
                       
                         
                
            <?php } ?>
                     </select>&nbsp;<a  style="cursor:pointer;" onClick="selectAllLocation();">Select All</a>&nbsp;|&nbsp;<a style="cursor:pointer;" onClick="unselectAllLocation();">UnSelect All</a>
                <div class="clear"></div>
            </div>-->

            <!--<div class="sec">
                <label>Service Category <span class="required">*</span></label>
                <select class="sect_category" name="serviceGroup[]" id="servicecategory" multiple>
                    <?php foreach($services as $cat){  $cat_ids = explode(",",$userinfo['service_category']);?>
                        <?php if(count($cat['subcat']) > 0){ ?>
                            <optgroup label="<?php echo $cat['catname'] ?>" style="padding-top: 10px;">
                                <?php foreach($cat['subcat'] as $subcat){ ?>
                                    <?php if(count($subcat['subcat']) > 0){ ?>
                                        <optgroup label="<?php echo $subcat['catname'] ?>" style="padding-left: 10px;">
                                            <?php foreach($subcat['subcat'] as $subsubcat){ ?>
                                                <option value="<?php echo $subsubcat['id'] ?>" <?php if(in_array($subsubcat['id'],$cat_ids)){ echo "selected"; } ?>><?php echo $subsubcat['catname'] ?></option>
                                            <?php } ?>
                                        </optgroup>

                                    <?php } else { ?>
                                        <option value="<?php echo $subcat['id'] ?>" <?php if(in_array($subcat['id'],$cat_ids)){ echo "selected"; } ?>><?php echo $subcat['catname'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </optgroup>

                        <?php } else { ?>
                            <option value="<?php echo $cat['id'] ?>" <?php if(in_array($cat['id'],$cat_ids)){ echo "selected"; } ?> ><?php echo $cat['catname'] ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>
            </div>-->
            
            <div class=" sec">
                <label>Country <span class="required">*</span></label>  <?php if(!isset($userinfo['country_code'])){$userinfo['country_code']='AU';}?>
                <select class="sect" name="country_code">
                    <?php foreach($countries as $country){ ?>
                        <option value="<?php echo $country['country_code'];?>" <?php if($userinfo['country_code'] == $country['country_code']){ echo"selected"; } ?>>
                            <?php echo $country['country_name'];?> (<?php echo $country['country_code'];?>)
                        </option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>

            <div class="sec">
                <label>Address <span class="required">*</span></label>
                <textarea name="address"><?php echo isset($userinfo['address'])?$userinfo['address']:''; ?></textarea>
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Postal Code</label>
                <input name="postal_code" type="text" value="<?php echo isset($userinfo['postal_code'])?$userinfo['postal_code']:''; ?>">
                <div class="clear"></div>
            </div>
            
            <div class="sec">
                <label>Edit Image</label>
                <img src="<?php echo PUBLICPATH."/profile/"; ?><?php if($userinfo['profile_image']){ echo $userinfo['profile_image'];} else { echo 'no_image.jpg'; }; ?>" class="edit_mg" height="129px" width="120px">
                <div class="upld">
                    <p><input type="file" name="image" value="Upload"> </p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

            <div class="sec">
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="update">
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>




<div style="display: block;" id="tab3" class="detail_buying_rquest">
    <div class="my_categori">
        <h3>My Categories</h3>
        <form action="" method="post" id="info" class="catadd" name="frmcategory" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />
        <input type="hidden" name="seller_id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
        <div class="sec">
            <label>Parent<span class="blue"> (optional)&nbsp;</span></label>
            <select name="parent" class="sect">
                <option value="0">-- Select Category --</option>
                <?php foreach($categories as $key=>$cat) {?>
                    <option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["parent"]){ echo"selected";} ?>><?php echo $cat; ?></option>
                <?php } ?>
            </select>
             <div class="clear"></div>
        </div>

        <div class="sec">
            <label>Category Name <span class="required">*</span></label>
            <input class="text" name="catname" type="text"  id="catname" size="35" value="<?php echo isset($ItfInfoData['catname'])?$ItfInfoData['catname']:'' ?>" />
 <div class="clear"></div>
        </div>
 
        <div class="sec">
            <label>Category Image </label>
            <input class="text" name="image" type="file"  id="image" size="35" />
            <?php if($ItfInfoData['image']){ ?>
                <div class="display"><img src="<?php echo PUBLICPATH."/categories/".$ItfInfoData['image']; ?>" height="40" width="40"/></div>
            <?php } ?>
            <div class="clear"></div>
        </div>
 
        <!-- Form Buttons -->
        <div class="sec">
        <label>&nbsp;</label>
            <input type="submit" name="submit" value="submit" />
            <div class="clear"></div>
        </div>
            <!-- End Form Buttons -->
    </form>
       
    </div>
    

</div>







<div style="display: none;" id="tab9" class="detail_buying_rquest">
    <h3>Add Catalogue</h3>
    <div class="money product">

        <form id="info"  class="addproduct" method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="seller_id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
        <div class="sec">
            <label>Select Category <span class="required">*</span></span></label>
            <select name="category_id" class="sect">
                <option value="">-- Select Category --</option>
                <?php foreach($categories as $key=>$cat) {?>
                    <option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["parent"]){ echo"selected";} ?>><?php echo $cat; ?></option>
                <?php } ?>
            </select>
             <div class="clear"></div>
        </div>

                <div class="sec">
                <label>Catalogue Code <span class="required">*</span> </label>
                <input type="text" name="code" value="">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Catalogue Name <span class="required">*</span> </label>
                <input type="text" name="name" value="">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Catalogue Image <span class="required">*</span></label>
                <input type="file" name="main_image" value="">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Catalogue Pdf <span class="required">*</span></label>
                <input type="file" name="pdf_name" value="">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Description<span class="required">*</span></label>
                <textarea name="logn_desc"></textarea>
                <div class="clear"></div>
            </div>
            
             <div class="sec">
                <label>Specification <span class="required">*</span></label>
                <textarea name="specification"></textarea>
                <div class="clear"></div>
            </div>


            <div class="sec">
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="Submit">
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>
</div>
</div></section>


<script type="text/javascript">


    $(function(){

       
      
        $('.addproduct').validate({
            rules: {
                name :{required:true},
                logn_desc: {required:true},
				code: {required:true},
				category_id: {required:true},
                main_image:{required:true,accept:'jpg|png|gif'}

            },
            messages: {
                main_image:{accept:'File must be jpg | png | gif extension '}
            }
        });


   $('.catadd').validate({
            rules: {
                catname :{required:true},
                detail: {required:true},
              

            },
            messages: {
                
            }
        });



    });




</script>
