<?php
if(isset($_POST['id']))
{
	if(!empty($_POST['id']))
	{
		$userobj->user_update($_POST);
		$userobj->admin_send_newsletter1($_POST);
		flash("Member is succesfully updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$obj->admin_send_newsletter($_POST);
		flash("Mail is succesfully sent");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
		}
}
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $userobj->getUserInfo($ids);



$objsite = new Site();
$countries = $objsite->getCountries();
$payment_types = array('credit_card'=>'Credit Card','account'=>'Account');
?>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
   
<script type="text/javascript">
$(document).ready(function() {

		
    $.validator.addMethod("noSpace", function(value, element) {

        var resinfo = parseInt(value.indexOf(" "));

        if(resinfo == 0 && value !="") { return false; } else return true;

    }, "Space are not allowed as first string !");

    var Validator = jQuery('#itffrminput').validate({
        rules: {

            name:{required:true, maxlength:'100', noSpace: true},
            last_name:{required:true, maxlength:'100', noSpace: true},
            email_phone:{required:true, number :true, noSpace: true},
            email: {required:true, email:true, },
			username:{required:true,
                <?php if(empty($ids)) { ?>
                remote: {
                    url: "<?php echo SITEURL; ?>/itf_ajax/index.php",
                    type: "post",
                    data: {
                        itfusername: function() {
                            return $( "#userid" ).val();
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

            payment_type:"required",
            country_code:"required"
        },
		messages: {
			
			name: " Please enter first name",
			last_name: " Please enter last name",
                        username: {required: "Please enter last name!" , remote: "Username already exists !"},
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
        <input type="hidden" name="usertype" value="<?php echo $ItfInfoData['usertype']; ?>" />
        <input type="hidden" name="memberid" value="<?php echo $ItfInfoData['memberid']; ?>">
        <div class="element">
            <label>First Name<span class="red">(required)</span></label>
            <input class="text" name="name" type="text"  id="name" size="35" readonly="readonly" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>" />
        </div>

        <div class="element">
            <label>Last Name<span class="red">(required)</span></label>
            <input class="text"  name="last_name" type="text"  id="last_name"  readonly="readonly" size="35" value="<?php echo isset($ItfInfoData['last_name'])?$ItfInfoData['last_name']:'' ?>" />
        </div>

        <div class="element">
            <label>Email id<span class="red">(required)</span></label>
            <?php if(empty($ids)){ ?>
                <input class="text" name="email" type="text"  id="email" size="35" value="<?php echo isset($ItfInfoData['email'])?$ItfInfoData['email']:'' ?>" />
            <?php } else{ ?>
                <input class="text" name="email2" type="text" readonly="readonly" size="35" value="<?php echo isset($ItfInfoData['email'])?$ItfInfoData['email']:'' ?>" />
            <?php } ?>
        </div>
        <div class="element">
            <label>Username<span class="red">(required)</span></label>
            <?php if(empty($ids)){ ?>
                <input class="text" name="username" type="text"  id="userid" size="35" value="<?php echo isset($ItfInfoData['username'])?$ItfInfoData['username']:'' ?>" />
            <?php } else{ ?>
                <input class="text" name="username2" type="text" readonly="readonly" size="35" value="<?php echo isset($ItfInfoData['username'])?$ItfInfoData['username']:'' ?>" />
            <?php } ?>
        </div>
       
<div class="element">
            <label>Register Date</label>
            <input class="text"  name="entrydate" type="text"  id="entrydate"  readonly="readonly" size="35" value="<?php echo isset($ItfInfoData['entrydate'])?$ItfInfoData['entrydate']:'' ?>" />
        </div>
        
        <div id="datetimepicker" class="input-append date element">
        
            <label>Expire Date</label>
      <input type="text"  name="expiry_date" id="expiry_date" value="<?php echo isset($ItfInfoData['expiry_date'])?$ItfInfoData['expiry_date']:'' ?>" ></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>
        
            
        
        <div class="element">
           
            <input type="hidden" name="send" value="<?php echo isset($ItfInfoData['email'])?$ItfInfoData['email']:'' ?>"> 
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

   <script type="text/javascript"
     src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
    </script> 
    <script type="text/javascript"
     src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
    <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd  hh:mm:ss',
        language: 'en-US'
      });
    </script>
