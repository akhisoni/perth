<?php
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$userobj->user_update($_POST);
		flash("Supplier is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$userobj->freeRegister($_POST);
		flash("Supplier is succesfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}
$category = new Category();
$categories = $category->getCategories();
foreach($categories as $categorys)
{
    $productGroup[] = $categorys;
}
//echo "<pre>";print_r($categories); echo "</pre>";
$serviceObj = new ServiceCategory();
$services = $serviceObj->getCategories();


$state = new State();
$areas = $state->getAllStateFront();

$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $userobj->getUserInfo($ids);
//print_r($ItfInfoData);

$objsite = new Site();
$countries = $objsite->getCountries();

?>
<script type="text/javascript">
$(document).ready(function() {

    var Validator = jQuery('#itffrminput').validate({
        rules: {

			name: "required",
			last_name: "required",
			email:{required:true,email:true,
                <?php if(empty($ids)) { ?>
                remote: {
                    url: "<?php echo SITEURL; ?>/itf_ajax/index.php",
                    type: "post",
                    data: {
                        emailid: function() {
                            return $( "#email" ).val();
                        }
                    }
                }
               <?php } ?>
			
			},
            <?php if(empty($ids)) { ?>
           'password': {
                required: true
            },
            <?php } ?>
           'password2': {
               <?php if(empty($ids)) { ?>
                required: true,
               <?php } ?>
                equalTo: '#password'
            },

            country_code:"required"
        },
		messages: {
			
			name: " Please enter first name",
			last_name: " Please enter last name",

			email:" Please enter valid email address",
			
		}
    });
});
</script>


<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
    <!-- Page Heading -->

    <form action="" method="post" name="itffrminput" id="itffrminput" >
        <input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['user_id'])?$ItfInfoData['user_id']:'' ?>" />
        <input type="hidden" name="usertype" value="3" />
        <input type="hidden" name="memberid" value="7">
        <div class="element">
            <label>First Name<span class="red">(required)</span></label>
            <input class="text" name="name" type="text"  id="name" size="35" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>" />
        </div>

        <div class="element">
            <label>Last Name<span class="red">(required)</span></label>
            <input class="text"  name="last_name" type="text"  id="last_name" size="35" value="<?php echo isset($ItfInfoData['last_name'])?$ItfInfoData['last_name']:'' ?>" />
        </div>

        <div class="element">
            <label>Email id<span class="red">(required)</span></label>
            <input class="text" name="email" type="text"  id="email" size="35" value="<?php echo isset($ItfInfoData['email'])?$ItfInfoData['email']:'' ?>" />
        </div>

        <div class="element">
            <label>Password<?php if(empty($ids)){ ?><span class="red">(required)</span> <?php } ?></label>
            <input class="text" name="password" type="password"  id="password" size="35" value="" />
        </div>

        <div class="element">
            <label>Verify Password <?php if(empty($ids)){ ?><span class="red">(required)</span> <?php } ?></label>
            <input class="text" name="password2" type="password"  id="password2" size="35" value="" />
        </div>

        <div class="element">
            <label>Address</label>
            <textarea name="address" class="textarea"><?php echo isset($ItfInfoData['address'])?$ItfInfoData['address']:'' ?></textarea>
        </div>

        <div class="element">
            <label>Country<span class="red">(required)</span></label>
            <?php echo Html::ComboBox("country_code",Html::CovertSingleArray($countries,"country_code","country_name"),$ItfInfoData['country_code'],array(),"Select Country"); ?>
        </div>

        <div class="element">
            <label>Business Phone</label>
            <input class="text" name="business_phone" type="text"  id="business_phone" size="35" value="<?php echo isset($ItfInfoData['business_phone'])?$ItfInfoData['business_phone']:'' ?>" />
        </div>
        <div class="element">
            <label>Mobile / Landline No.</label>
            <input class="text" name="email_phone" type="text"  id="email_phone" size="35" value="<?php echo isset($ItfInfoData['email_phone'])?$ItfInfoData['email_phone']:'' ?>" />
        </div>
        <div class="element">
            <label>Company Name</label>
            <input class="text" name="company_name" type="text"  id="company_name" size="35" value="<?php echo isset($ItfInfoData['company_name'])?$ItfInfoData['company_name']:'' ?>" />
        </div>
         <div class="element">
            <label>Company ABN</label>
            <input class="text" name="company_abn" type="text"  id="company_abn" size="35" value="<?php echo isset($ItfInfoData['company_abn'])?$ItfInfoData['company_abn']:'' ?>" />
        </div>
          <div class="element">
            <label>Company Address</label>
            <input class="text" name="company_address" type="text"  id="company_address" size="35" value="<?php echo isset($ItfInfoData['company_address'])?$ItfInfoData['company_address']:'' ?>" />
        </div>
         <div class="element">
            <label>Company Suburb</label>
            <input class="text" name="company_subrub" type="text"  id="company_subrub" size="35" value="<?php echo isset($ItfInfoData['company_subrub'])?$ItfInfoData['company_subrub']:'' ?>" />
        </div>
       <div class="element">
            <label>Company state</label>
            <input class="text" name="company_state" type="text"  id="company_state" size="35" value="<?php echo isset($ItfInfoData['company_state'])?$ItfInfoData['company_state']:'' ?>" />
        </div>
       <div class="element">
            <label>Company Product Groups</label>
            <select class="upload" name="productGroup[]" id="category" multiple>
                    <?php foreach($categories as $cat){ 
                            $find = $cat['id']; 
                            $pattern = "/(^$find,|,$find,|,$find$)/";        
                        ?>
                        <option value="<?php echo $cat['id'] ?>" <?php  if (0 != preg_match($pattern, $ItfInfoData['product_group_id'])) {echo "selected='selected'";}?>><?php echo $cat['catname'] ?></option>
                    <?php } ?>

                </select>
        </div>
           <div class="element">
            <label>Company Service Groups</label>
            <select class="upload" name="serviceGroup[]" id="servicecategory" multiple>
                   
                    <?php foreach($services as $cat){ ?>
                         
                        <?php if(count($cat['subcat']) > 0){ ?>
                    
                            <optgroup label="<?php echo $cat['catname'] ?>" style="padding-top: 10px;">
                                <?php foreach($cat['subcat'] as $subcat){ ?>
                                    <?php if(count($subcat['subcat']) > 0){ ?>
                               
                                        <optgroup label="<?php echo $subcat['catname'] ?>" style="padding-left: 10px;">
                                            <?php foreach($subcat['subcat'] as $subsubcat){ 
                                                 $find = $subsubcat['id']; 
                                                 $pattern = "/(^$find,|,$find,|,$find$)/";      
                                                
                                                ?>
                                                <option value="<?php echo $subsubcat['id'] ?>" <?php  if (0 != preg_match($pattern, $ItfInfoData['service_category'])) {echo "selected='selected'";}?>><?php echo $subsubcat['catname'] ?></option>
                                            <?php } ?>
                                        </optgroup>

                                    <?php } else { 
                                                 $find = $subcat['id']; 
                                                 $pattern = "/(^$find,|,$find,|,$find$)/"; 
                                        
                                        ?>
                                        <option value="<?php echo $subcat['id'] ?>" <?php  if (0 != preg_match($pattern, $ItfInfoData['service_category'])) {echo "selected='selected'";}?>><?php echo $subcat['catname'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </optgroup>

                        <?php } else { ?>
                            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['catname'] ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>
        </div>
          <div class="element">
            <label>Company Service Areas</label>
            <select class="upload" name="serviceArea[]" id="categorys" multiple onchange="changeSelection(this.value)">
                 <option value="">-- Select All Company Service Areas --</option> 
                      <?php foreach($areas as $area){ 
                           $find = $area['id']; 
                            $pattern = "/(^$find,|,$find,|,$find$)/";   
                          
                          ?>
                 
                     <option value="<?php echo $area['id']; ?>" <?php  if (0 != preg_match($pattern, $ItfInfoData['city_id'])) {echo "selected='selected'";}?>><?php echo $area['name']; ?></option>
                
             
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