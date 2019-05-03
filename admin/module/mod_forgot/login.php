<?php
$Userss=new User();
if(isset($_REQUEST['uname'],$_REQUEST['pass']))
{
if($Userss->loginAdminUser($_REQUEST['uname'],$_REQUEST['pass']))
	{
		redirectUrl('itfmain.php');
	}
	else
	{
		flash("User and Password is Invalid",2);
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
    var Validator = jQuery('#itflogin').validate({
       rules: {
           uname: "required",
		pass: "required",
		},
	
	messages: {
		
		uname: " Please enter user name",
		pass: " Please enter password"	
	},
	errorPlacement: function(error, element) {
		error.appendTo( element.parent().prev() );
	},
	success: function(label) {
		label.html("&nbsp;").addClass("itfok");
	}
    });
});
</script>

<div class="login_form_block">
  <div class="login_title">Administrator Login</div>
  <?php flashMsg(); ?>
  <div class="login_form">
    <form id="itflogin" name="itflogin" method="post" action="" >
      <p>User Name <span class="required">*</span></p>
      <p>
        <input name="uname" type="text" id="uname" class="form-login formminp" />
      </p>
      <p>Password <span class="required">*</span></p>
      <p>
        <input  name="pass" type="password" id="pass" class="form-login formminp" />
      </p>
      <div class="sep"></div>
      <button type="submit" class="ok">Login</button>
      <a href="index.php?itfpage=forgot" class="button" >Forgot password?</a>
    </form>
  </div>
</div>
