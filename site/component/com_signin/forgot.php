<?php
$obj = new User();
if(isset($_POST["email"]))
{
    if(!empty($_POST["email"])){

       if($forgot = $obj->ForgotPassword($_POST["email"])){
            flashMsg("Your new password has been sent to your email address!");
            redirectUrl(CreateLink(array("signin")));
        } else {
            flashMsg("No user exist related with this email id !","2");
        }
    } else {

        flashMsg("Empty Username not allowed !","2");
    }
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $.validator.addMethod("noSpace", function(value, element) {
        var resinfo = parseInt(value.indexOf(" "));
        if(resinfo == 0 && value !="") { return false; } else return true;
    }, "Space not allowed in the starting of string !");
    $('#sgn').validate({
        rules: {
            email: {required:true,},
            username:{required:true,
				remote: {

							url: "<?php echo SITEURL; ?>itf_ajax/index.php",

							type: "post",

							data: {

								itfusername: function() {

									return $( "#userid" ).val();

								}

							}

						}

			},    

            password:{required:true, noSpace: true},

           

        },

        messages: {

           

            email: {required: ""},

            password:{ required: ""},



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
    <li>Forgot Password</li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Forgot Password</h1>
  </div>
  
<div class="inner_content">
<div class="col-sm-12">
                <div class="new-login-form">
                	     <form id="sgn" name="signin" method="post" action="">
                         <ul class="list-unstyled reg-form">
            <li>
              <input type="text" name="email" placeholder="Enter your email id" class="field">
            </li>
            <br/>
            <li> <a href="<?php echo CreateLink(array('signin')); ?>">Go to Login</a></li>
            <br/>
            <li>
              <div class="lgin">
                <input name="submit" type="submit" value="Submit">
              </div>
              
            </li></ul>
          </form>
                </div>
</div>
</div>
</div>
</div>






</div>
