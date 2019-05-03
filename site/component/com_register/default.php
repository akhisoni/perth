<?php
$userobj=new User();
$datas=$userobj->getAllmemberPlan();
$Supdatas=$userobj->getAllmemberPlanSup();
$Bothdatas=$userobj->getAllmemberPlanBoth();
//echo "<pre>";print_r($datas);die;
$obj = new User();
if(isset($_POST['submit']) && !empty($_POST['email'])){
// code for check server side validation
    if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
    {
        flashMsg("The Validation code does not match!","2");
    } else {
           //$id=$obj->getLastId();
           //echo "<pre>";print_r($id);die;
          //$_SESSION['maxid']=$_POST['max(id)'];
          $_SESSION['memberid']=$_POST['memberid'];
          $payment=$obj->getCheckPayMem($_SESSION['memberid']);
          $value=$payment['amount'];
           if($value==0)
           {
                 $obj->freeRegister($_POST);
                  flashMsg("You have successfully registered on Australiads.");
                 redirectUrl(CreateLink(array("signin")));
           }
          else {
     
     $res = $obj->customerRegisterTemp($_POST);
          $_SESSION['temId']=$res;
             }
          
//          echo "fakhare";echo $res;die;
        //$res = $obj->customerRegister($_POST);
        if($res){
           
            redirectUrl(CreateLink(array("payment")));

        } elseif($res && $_POST['payment_type'] == "account"){
            flashMsg("Thanks for registering with Australiads, you will shortly receive an email your account activated.","3");
            redirectUrl(CreateLink(array("register","itemid"=>"customer")));

        } else {
            flashMsg("Something went wrong.","2");
            redirectUrl(CreateLink(array("register","itemid"=>"customer")));

        }
    }
}



?>

<script type="text/javascript">
$(document).ready(function() {
    $.validator.addMethod("noSpace", function(value, element) {
        var resinfo = parseInt(value.indexOf(" "));
        if(resinfo == 0 && value !="") { return false; } else return true;
    }, "Space not allowed in the starting of string !");

    $('#custom').validate({
        rules: {
            name:{required:true, maxlength:'100', noSpace: true},
            last_name:{required:true, maxlength:'100', noSpace: true},
            email_phone:{required:true, number:true},
            email: {required:true, email:true, },
            email:{required:true,
				remote: {
							url: "<?php echo SITEURL; ?>/itf_ajax/index.php",
							type: "post",
							data: {
								itfusername: function() {
									return $("#email").val();
								}
							}
						}
			},    
            password:{required:true, minlength:8, maxlength:20, noSpace: true},
            verify_password:{required:true, minlength:8, maxlength:20, equalTo:"#password"},
            //payment_type:"required",
            terms_condition:"required",
            '6_letters_code':"required"

        },
        messages: {
            name:{required:""},
            last_name: {required:"" },
            email_phone: {required:""},
            //payment_type: "",
            terms_condition: "",
            email: {required: ""},
            email: {required: "" , remote: "emailid already exists !"},
            password:{ required: ""},
            verify_password:{ required: "", equalTo:"Password not match !"},
            '6_letters_code':""

        }
    });


});
</script>
<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li>Register</a></li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Register</h1>
  </div>
  
<div class="inner_content">
<div id="buyer-signup" class="tab-pane fade in active">
             
              
                <form id="custom" name="registration" method="post" action="">
                  <input type="hidden" name="memberid" value="6">
                  <ul class="list-unstyled reg-form">
                    <li>
                      <input type="text" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:""; ?>" class="field" placeholder="First Name...">
                    </li>
                    <li>
                    
                      <input type="text" name="last_name" value="<?php echo isset($_POST['last_name'])?$_POST['last_name']:""; ?>" placeholder="Last Name..." class="field">
                    </li>
                    <li>
                    
                      <input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:""; ?>" placeholder="Email Id..." class="field">
                    </li>
                   
                
                 
                    <li>
                        <input type="password"  name="password" id="password" placeholder="Choose Password" class="field">
                      
                    </li>
                    <li>
                     <input type="password" name="verify_password" id="verify_password" placeholder="Re-type your passowrd" class="field">
                      
                    </li>
                    <li>
                      <input name="6_letters_code" type="text" id="6_letters_code" placeholder="Captcha" class="field capt">
                      <br>
                      <img src="<?php echo SITEURL;?>/itf_ajax/captcha_code_file.php?rand=<?php echo rand();?>" id='captchaimg'>
                      Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</li>
                    <li>
                      <input type="submit" name="submit" value="Register" class="rgst-btn">
                    </li>
                  </ul>
                </form>
              </div>
</div>
</div>
</div>






</div>


<script type='text/javascript'>
    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
</script> 
