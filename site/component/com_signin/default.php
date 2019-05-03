<?php

    if(!empty($_SESSION['FRONTUSER'])){

        if($_SESSION['FRONTUSER']['usertype'] == 2){

            //redirectUrl(CreateLink(array("customer")));

			redirectUrl(CreateLink(array("dashboard")));

        }

      

    }



    if(isset($_POST["email"]))

    {

        if(!empty($_POST["email"])){

            $logininfo = $obj->userLogin($_POST["email"],$_POST["password"]);

     
	  if($logininfo==1){

         // flashMsg("Your membership plan is expired. Please contact admin.");
redirectUrl(CreateLink(array("customer")));
      }

      else

      {

            if($logininfo or !empty($_SESSION['FRONTUSER'])){

                if($_SESSION['FRONTUSER']['usertype'] == 2){

                    //redirectUrl(CreateLink(array("customer")));

					redirectUrl(CreateLink(array("dashboard")));

                }

                if($_SESSION['FRONTUSER']['usertype'] == 3){

                   // redirectUrl(CreateLink(array("supplier")));

				   redirectUrl(CreateLink(array("dashboard")));

                }

				if($_SESSION['FRONTUSER']['usertype'] == 4){

           // redirectUrl(CreateLink(array("supplier")));

		   redirectUrl(CreateLink(array("dashboard")));

        }

            } else {

                flashMsg("Email id and Password do not match or you do not have an account yet.","2");

                redirectUrl(CreateLink(array("signin")));

            }

        }

        

        }

        else {

            flashMsg("Empty Username / Password not allowed.","2");

            redirectUrl(CreateLink(array("signin")));

        }

    }

if(isset($_GET['msg']) and $_GET['msg']=="na" ){

    echo "<div class='msgbox n_error'><p>If you are not yet a customer please Register.</p></div>";

}

if(isset($_GET['msg']) and $_GET['msg']=="view" ){

    echo "<div class='msgbox n_error'><p>To see the Buying Request you have to login as Seller User</p></div>";    

}

if(isset($_GET['msg']) and $_GET['msg']=="view_seller" ){

    echo "<div class='msgbox n_error'><p>Only login with Seller User can see the Buying Request</p></div>";

    

}

if($_REQUEST['id']!= ''){
	$id = $_REQUEST['id'];
	$sdf = "update itf_user_profile set expiry_date='".date('Y-m-d',strtotime('+365 days'))."' where id ='".$id."'";
	  mysql_query($sdf);
	      echo "<div class='msgbox n_ok'><p>Membership Renew</p></div>";
    
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

									return $( "#emailid" ).val();

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
    <li>Sign in</li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Sign in</h1>
  </div>
  
<div class="inner_content">
<div class="col-sm-12">
                <div class="new-login-form">
                	<form id="sgn" name="signin" method="post" action="">
                    <ul class="list-unstyled reg-form">
                         <li><input name="email"  id="email" placeholder="Enter your Email id" type="text" class="field"></li>
                        <li> <input name="password" placeholder="Enter your Password" type="password" class="field"></li>
                       <li class="full"><input name="submit" type="submit" value="Login" class="log-btn">
                       <div class="login-links"><a href="<?php echo CreateLink(array('signin','itemid'=>'forgot')); ?>">Forgot Password ?</a><br>
New User <a href="<?php echo CreateLink(array('register')); ?>">Register here !</a></div>
                       </li>
                    </ul>
                    </form>
                </div>
</div>
</div>
</div>
</div>






</div>