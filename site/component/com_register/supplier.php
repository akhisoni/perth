<?php
Html::AddJavaScript("register/assests/jquery.validate.password.js","component");
Html::AddStylesheet("register/assests/jquery.validate.password.css","component");
$obj = new User();

$category = new Category();
$categories = $category->getCategories();
foreach($categories as $categorys)
{
    $productGroup[] = $categorys;
}

$serviceObj = new ServiceCategory();
$services = $serviceObj->getCategories();

$state = new State();
$areas = $state->getAllStateFront();

//print_r($productGroup); die;
if(isset($_POST['submit']) && !empty($_POST['email'])){

    // code for check server side validation
    if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
    {
        flashMsg("The Validation code does not match!","2");
    }else{
        //$id=$obj->getLastId();
        //echo "<pre>";print_r($id);die;
          //$_SESSION['maxid']=$_POST['max(id)'];
          $_SESSION['memberid']=$_POST['memberid'];
          $payment=$obj->getCheckPayMem($_SESSION['memberid']);
        
          $value=$payment['amount'];
           if($value==0)
           {
                 $obj->freeRegister($_POST);
                  flashMsg("You have successfully registered on Plucka.");
                 redirectUrl(CreateLink(array("signin")));
           }
          else {
     
     $res = $obj->customerRegisterTemp($_POST);
          $_SESSION['temId']=$res;
             }
//        $res = $obj->supplierRegister($_POST);
        if($res ){
                    redirectUrl(CreateLink(array("payment")));

        } else {
            flashMsg("Something went wrong.","2");
            redirectUrl(CreateLink(array("register","itemid"=>"supplier#msgbox")));

        }
    }

        
}
	
?>
<script type="text/javascript">

    $.validator.addMethod("noSpace", function(value, element) {

        var resinfo = parseInt(value.indexOf(" "));

        if(resinfo == 0 && value !="") { return false; } else return true;

    }, "Space not allowed in the starting of string !");

    $(document).ready(function() {

        $('#custom').validate({
            rules: {
                company_name:{required:true, maxlength:100, noSpace: true},
             
                name:{required:true, maxlength:100, noSpace: true},

                email_phone:{required:true, number: true},
                last_name:{required:true, maxlength:100, noSpace: true},
                email: {required:true, email:true,},
                
                 username:{required:true,
				remote: {
							url: "<?php echo SITEURL; ?>/itf_ajax/index.php",
							type: "post",
							data: {
								itfusername: function() {
									return $( "#username" ).val();
								}
							}
						}
			}, 
             
                password:{required:true,minlength:8, maxlength:20, noSpace: true},
                verify_password:{required:true, equalTo:"#password"},
                '6_letters_code':"required",
                terms_condition:"required",
                'serviceArea[]':"required"

            },
            messages: {
                name:{required:"You must fill in all of the fields !"},
                email_phone: {required:"You must fill in all of the fields !" },
                company_name:{required:"You must fill in all of the fields !"},
              
                last_name: {required:"You must fill in all of the fields !", maxlength:"Please enter less than 100 characters !" },
                terms_condition: "You must fill in all of the fields !",
                email: {required: "You must fill in all of the fields !"},
                username: {required: "You must fill in all of the fields !" , remote: "Username already exists !"},
                password:{ required: "You must fill in all of the fields !"},
                verify_password:{ required: "You must fill in all of the fields !", equalTo:"Password not match !"},
                '6_letters_code':"You must fill in all of the fields !",
                'serviceArea[]':"Please select at least one service area !",
                'serviceGroup[]':"Please select at least one service category !"

            }
        });

    });
</script>
<section class="section">
<div class="center_main">
<div class="register-imge">
<ul>
<li><h1>WELCOME TO <img src="<?php echo TemplateUrl();?>image/RegisterNowBanner.png"/> </h1></li>
<li></li>
</ul>

</div>
<div class="logi-page">
<form id="custom" name="registration" method="post" action="">
<input type="hidden" name="memberid" value="<?php echo $_GET['id']; ?>">
<ul>
<li><span>*</span> Indicates required fields</li>

<li>First Name<span>*</span></li>
<li> <input type="text" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:""; ?>" class="in-login"></li>
<li>Last Name<span>*</span></li>
<li> <input type="text"  name="last_name" value="<?php echo isset($_POST['last_name'])?$_POST['last_name']:""; ?>" class="in-login"></li>
<li>Email<span>*</span></li>
<li> <input type="text"  name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:""; ?>" class="in-login"></li>
<li>Username<span>*</span></li>
<li><input type="text" name="username" id="username"  value="<?php echo isset($_POST['username'])?$_POST['username']:""; ?>" class="in-login"></li>
<li>Company Name</li>
<li><input type="text" name="company_name" value="<?php echo isset($_POST['company_name'])?$_POST['company_name']:""; ?>" class="in-login"></li>
<li>Password<span>*</span></li>
<li><input type="password" class="in-login" name="password" id="password">
</li>
<li>Confirm Password<span>*</span></li>
<li><input type="password" name="verify_password" id="verify_password" class="in-login"></li><br/>
<li><img src="<?php echo SITEURL;?>/itf_ajax/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'>
<br/>
Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</li>
<li>Enter the above code here <span class="required">*</span></li>
<li><input id="6_letters_code" name="6_letters_code" type="text" class="in-login"></li>
</ul>
<div class="submit"><input type="submit" name="submit" value="Register"></div>
</form>

</div>
</div>
</section>
<?php /*?><div class="main_mat">
<p><a href="<?php echo ITFPATH; ?>">Home</a> / <a href="#">Supplier Registration</a></p>
</div>
<div class="about_us"><h3>Supplier Registration</h3></div>
<div class="custom_info">
<h3>Company Details</h3>
    <div class="custom">
        <form id="custom" name="registration" method="post" action="">
            <input type="hidden" name="memberid" value="<?php echo $_GET['id']; ?>">
            <div class="reg">
            <label>Company Name <span class="required">*</span></label>
            <input type="text" name="company_name" value="<?php echo isset($_POST['company_name'])?$_POST['company_name']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Company ABN</label>
            <input type="text" name="company_abn" value="<?php echo isset($_POST['company_abn'])?$_POST['company_abn']:""; ?>" >
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Company Address</label>
            <input type="text" name="company_address" value="<?php echo isset($_POST['company_address'])?$_POST['company_address']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Company Suburb</label>
            <input type="text" name="company_subrub" value="<?php echo isset($_POST['company_subrub'])?$_POST['company_subrub']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Company State</label>
            <input type="text" name="company_state" value="<?php echo isset($_POST['company_state'])?$_POST['company_state']:""; ?>">
            <div class="clear"></div>
            </div>
            <h3>Company Contact Details</h3>
            <div class="reg">
            <label>First Name <span class="required">*</span></label>
            <input type="text" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Last Name <span class="required">*</span></label>
            <input type="text" name="last_name" value="<?php echo isset($_POST['last_name'])?$_POST['last_name']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Email Address <span class="required">*</span></label>
            <input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Username <span class="required">*</span></label>
            <input type="text" name="username" id="userid" value="<?php echo isset($_POST['username'])?$_POST['username']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label> Registration Code<!-- Business Phone --></label>
            <input type="text" name="business_phone" value="<?php echo isset($_POST['business_phone'])?$_POST['business_phone']:""; ?>">
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Mobile / Landline No. <span class="required">*</span></label>
            <input type="text" name="email_phone" value="<?php echo isset($_POST['email_phone'])?$_POST['email_phone']:""; ?>">
            <div class="clear"></div>
            </div>
            <h3>Company Product Groups</h3>

            <div class="chebox cheboxCat">


                <select class="upload" name="productGroup[]" id="category" multiple>
                    <?php foreach($categories as $cat){ 
                        
            
                        ?>
                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['catname'] ?></option>
                    <?php } ?>

                </select>
            </div>
           
            <div class="clear"></div>

            <h3>Company Service Groups</h3>

            <div class="chebox cheboxCat servicecategory">

                <select class="upload" name="serviceGroup[]" id="servicecategory" multiple>
                   
                    <?php foreach($services as $cat){ ?>
                         
                        <?php if(count($cat['subcat']) > 0){ ?>
                    
                            <optgroup label="<?php echo $cat['catname'] ?>" style="padding-top: 10px;">
                                <?php foreach($cat['subcat'] as $subcat){ ?>
                                    <?php if(count($subcat['subcat']) > 0){ ?>
                               
                                        <optgroup label="<?php echo $subcat['catname'] ?>" style="padding-left: 10px;">
                                            <?php foreach($subcat['subcat'] as $subsubcat){ ?>
                                                <option value="<?php echo $subsubcat['id'] ?>"><?php echo $subsubcat['catname'] ?></option>
                                            <?php } ?>
                                        </optgroup>

                                    <?php } else { ?>
                                        <option value="<?php echo $subcat['id'] ?>"><?php echo $subcat['catname'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </optgroup>

                        <?php } else { ?>
                            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['catname'] ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>

            </div>

            <div class="clear"></div>

            <h3>Company Service Areas <span class="required">*</span></h3>
            <div class="chebox areas">
               <!-- <select class="upload" name="serviceArea[]" id="categorys" multiple onchange="changeSelection(this.value)">-->
                <select class="upload" name="serviceArea[]" id="categorys" multiple >
                 <option value="">-- Select All Company Service Areas --</option> 
                      <?php foreach($areas as $area){ ?>
                 
                     <option value="<?php echo $area['id']; ?>"><?php echo $area['name']; ?></option>
                
             
                    <?php } ?>
                     </select>
            </div>
            <div class="clear"></div>
            <div class="reg">
            <label>Password <span class="required">*</span></label>
            <input type="password" class="password" name="password" id="password">
            <div class="password-meter">
                    <div class="password-meter-message">Too Short&nbsp;</div>
                    <div class="password-meter-bg">
                            <div class="password-meter-bar"></div>
                    </div>
            </div>
            <div class="clear"></div>
            </div>
            <div class="reg">
            <label>Verify Password <span class="required">*</span></label>
            <input type="password" name="verify_password" id="verify_password">
            <div class="clear"></div>
            </div>

            <div class="clear"></div>
            <div class="reg">
                <label>Validation code</label>
                <div class="cpatcha">
                    <img src="<?php echo SITEURL;?>/itf_ajax/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'>
                    <br>
                    Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh
                </div>
            </div>
            <div class="clear"></div>
            <div class="reg">
                <label for='message'>Enter the above code here <span class="required">*</span></label>
                <div class="inputbox"><input id="6_letters_code" name="6_letters_code" type="text"></div>
            </div>

            <div class="clear"></div>
            <div class="reg terms">
                <div class="inputbox"><input name="terms_condition" type="checkbox" value="" class="cond"> Accept Terms & Conditions</div>
            </div>
           <div class="reg">
            <label>&nbsp;</label>
            <input type="submit" name="submit" onclick="return validate();" value="register">
            <div class="clear"></div>
            </div>
        </form>
    </div>
</div>
<?php */?>
<script type='text/javascript'>
    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
    
        function changeSelection(value){

      var length = document.getElementById("categorys").options.length;

      if(value == 0){
      for(var i = 1;i<length;i++)
        document.getElementById("categorys").options[i].selected = "selected";

      document.getElementById("categorys").options[0].selected = "";
      }

  }
</script>
