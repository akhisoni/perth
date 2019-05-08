<?php
$msgs = "Login";
require('../itfconfig.php');
if(!AdminLogins())
redirectUrl('index.php');
require('pagecreation.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl"><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Pawe? 'kilab' Balicki - kilab.pl" />
<title><?php echo $stieinfo['sitename'].' | Admin Panel'; ?></title>
<!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>
    
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


<?php

Html::AddCssFile("css/style.css");
Html::AddCssFile("css/navi.css");
///Html::AddCssFile("css/tcal.css");
//Html::AddCssFile("../itfbox/itfboxcss.css");
//Html::AddCssFile("css/jquery-ui-timepicker-addon.css");
echo Html::Css();
if($_REQUEST['actions']=='add'){
//Html::AddJsFile("js/jquery.js");
}
//Html::AddJsFile("../itfbox/itfboxpack.js");
Html::AddJsFile("js/menujs.js");
//Html::AddJsFile("js/jquery.validate.js");
Html::AddJsFile("js/itf_mask.js");
Html::AddJsFile("js/jquery.form.js");
//Html::AddJsFile("js/tcal.js");
//	Html::AddJsFile("js/jquery-ui-timepicker-addon.js");

echo Html::Js();
?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
$(".box .h_title").not(this).next("ul").hide("normal");
$(".box .h_title").not(this).next(".<?php echo $currentpage; ?>").show("normal");
$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>
<body>
<div class="wrap">
  
  <?php if($_SESSION['LoginInfo']['USERTYPE']!=null and $_SESSION['LoginInfo']['USERTYPE']==1){?>
  <div id="header">
    <div id="top">
      <div class="left"> <a href="<?php echo CreateLinkAdmin(array('index')); ?>"><img src="img/logo.png" width=100px;/></a> </div>
      <div class="right">
        <div class="align-right">
          <p>Welcome, <strong><?php echo WordLimit($_SESSION['LoginInfo']['USNAME'],1); ?></strong> [ <a href="logouts.php">logout</a> ]</p>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div id="sidebar">
      <div class="box">
        <div class="h_title">&circleddash; Main control</div>
        <ul class="index service_category">
          <li class="b1"><a class="icon view_page" href="<?php echo SITEURL; ?>" target="_blank">Visit Site</a></li>
          <!-- <li class="b1"><a class="icon order" href="<?php echo CreateLinkAdmin(array('report','actions'=>'order')); ?>">View all Orders</a></li>
<li class="b1"><a class="icon add_page" href="<?php echo CreateLinkAdmin(array('cms','actions'=>'add')); ?>">Add New Page</a></li>
<li class="b2"><a class="icon config" href="<?php echo CreateLinkAdmin(array('config')); ?>">Site Config</a></li>
<li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
<li class="b2"><a class="icon category" href="<?php echo CreateLinkAdmin(array('service_category')); ?>">Service Categories</a></li>-->
        </ul>
      </div>
      <div class="box">
        <div class="h_title">&circleddash; Category Management</div>
        <ul class="product category">
              <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('category')); ?>">Categories</a></li>
            <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('category','actions'=>'add')); ?>">Add New Category</a></li>
        </ul>
      </div>
        
         <div class="box">
        <div class="h_title">&circleddash; Events Management</div>
        <ul class="events">
              <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('events')); ?>">Events</a></li>
              <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('events','actions'=>'add')); ?>">Add New Event</a></li>
        </ul>
      </div>
        
        
        <div class="box">
        <div class="h_title">&circleddash; News Management</div>
        <ul class="news">
          <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('news')); ?>">News & Articles Details</a></li>
          <li class="b1"><a class="icon category" href="<?php echo CreateLinkAdmin(array('news','actions'=>'add')); ?>">Add News & Articles</a></li>
        </ul>
      </div>
      <div class="box">
        <div class="h_title">&circleddash; Content Management</div>
        <ul class="cms">
          <li class="b1"><a class="icon page" href="<?php echo CreateLinkAdmin(array('cms')); ?>">Show all Pages</a></li>
          <li class="b1"><a class="icon add_page" href="<?php echo CreateLinkAdmin(array('cms','actions'=>'add')); ?>">Add New Page</a></li>
        </ul>
      </div>
      
      <!--  <div class="box">
<div class="h_title">&#8250; Reports Management</div>
<ul class="report">
<li class="b1"><a class="icon order" href="<?php echo CreateLinkAdmin(array('report','actions'=>'order')); ?>">View all Orders</a></li>
<li class="b1"><a class="icon payment" href="<?php echo CreateLinkAdmin(array('report','actions'=>'transaction')); ?>">View all Transactions</a></li>
</ul>
</div>--> 
      
      <!--  <div class="box">
<div class="h_title">&#8250; Manage By Account Quote</div>
<ul class="quote">
<li class="b1"><a class="icon task" href="<?php echo CreateLinkAdmin(array('quote')); ?>">View all Quotes</a></li>
</ul>
</div>--> 
          <div class="box">
<div class="h_title">&circleddash; Order Management</div>
<ul class="order">
<li class="b1"><a class="icon task" href="<?php echo CreateLinkAdmin(array('order')); ?>">View All Orders</a></li>
<!--<li class="b1"><a class="icon task" href="<?php echo CreateLinkAdmin(array('enquiry','actions'=>'list')); ?>">View all Clarifications</a></li>-->
</ul>
</div>

<!--<div class="box">
<div class="h_title">&circleddash; Customer Enquiry Management</div>
<ul class="enquiry">
<li class="b1"><a class="icon task" href="<?php echo CreateLinkAdmin(array('enquiry')); ?>">View Customer Enquiry</a></li>
</ul>
</div>-->


       <!--<div class="box">
        <div class="h_title">&circleddash; Discount Management</div>
        <ul class="discount">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('discount')); ?>">Discounts</a></li>
        </ul>
      </div>-->
   <!--   <div class="box">
        <div class="h_title">&circleddash; Advertise Management</div>
        <ul class="advertise">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('advertise')); ?>">Advertise</a></li>
        </ul>
      </div>-->
      <!--<div class="box">
        <div class="h_title">&circleddash; APP Slider Management</div>
        <ul class="banner">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('banner')); ?>">APP Slider</a></li>
        </ul>
      </div>-->
      
       <div class="box">
        <div class="h_title">&circleddash; Home Slider Management</div>
        <ul class="website_banner">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('website_banner')); ?>">Home Slider</a></li>
        </ul>
      </div>
       
       <div class="box">
        <div class="h_title">&circleddash; Home Page Sections</div>
        <ul class="homepage">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('homepage')); ?>">Home Page Sections</a></li>
        </ul>
      </div>
      <div class="box">
        <div class="h_title">&circleddash; Testimonial Management</div>
        <ul class="testimonial">
          <li class="b1"><a class="icon users" href="<?php echo CreateLinkAdmin(array('testimonial')); ?>">Testimonials</a></li>
        </ul>
      </div>
      <div class="box">
        <div class="h_title">&circleddash; Users Management</div>
        <ul class="user supplier both membership member">
          <li class="b1"><a class="icon users" href="<?php echo CreateLinkAdmin(array('user')); ?>">Customer Management</a></li>
        <li class="b1"><a class="icon users" href="<?php echo CreateLinkAdmin(array('supplier')); ?>">Member Management</a></li>
                   <!--<li class="b1"><a class="icon users" href="<?php echo CreateLinkAdmin(array('rider')); ?>">Rider Management</a></li>
           <li class="b1"><a class="icon users" href="<?php echo CreateLinkAdmin(array('moderator')); ?>">Moderator Management</a></li>
           -->
        
        <!--<li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('both')); ?>">Buyers/Sellers</a></li>
        <li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('membership')); ?>">Manage Membership</a></li>
        <li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('member')); ?>">Manage Members</a></li>-->
        </ul>
      </div>
      <!--<div class="box">
        <div class="h_title">&circleddash; Zone Management</div>
        <ul class="help">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('zone')); ?>">Zone</a></li>
        </ul>
      </div>-->
    <!--  <div class="box">
        <div class="h_title">&circleddash; Help Management</div>
        <ul class="help">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('help')); ?>">Help</a></li>
        </ul>
      </div>-->
     <!-- <div class="box">
        <div class="h_title">&circleddash; Package Management</div>
        <ul class="paid_ad">
          <li class="b1"><a class="icon message" href="<?php echo CreateLinkAdmin(array('package')); ?>">Package Management</a></li>
        </ul>
      </div>-->
      <!--  <div class="box">
        <div class="h_title">&circleddash; Newsletter Management</div>
        <ul class="newsletter">
        <li class="b1"><a class="icon send_message" href="<?php echo CreateLinkAdmin(array('newsletter','actions'=>'send')); ?>">Send Newsletter</a></li>
        <li class="b1"><a class="icon send_message" href="<?php echo CreateLinkAdmin(array('newsletter')); ?>">Newsletter Templates</a></li>
        <li class="b1"><a class="icon group" href="<?php echo CreateLinkAdmin(array('newsletter','actions'=>'subscriber')); ?>">Subscribe Members</a></li>
        </ul>
        </div>-->
      <div class="box">
        <div class="h_title">&circleddash; Profile Settings</div>
        <ul class="config profile password state">
          <li class="b1"><a class="icon config" href="<?php echo CreateLinkAdmin(array('config')); ?>">Site Configuration</a></li>
          <li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
          <li class="b1"><a class="icon password" href="<?php echo CreateLinkAdmin(array('password')); ?>">Change Password</a></li>
<!--          <li class="b1"><a class="icon city" href="<?php echo CreateLinkAdmin(array('state')); ?>">Manage Locations</a></li>
-->          <!--  <li class="b1"><a class="icon city" href="<?php echo CreateLinkAdmin(array('program')); ?>">Paypal Details</a></li>-->
        </ul>
      </div>
    </div>
    <div id="main">
      <?php flash(); ?>
      <?php echo $itf_body_contents; ?> </div>
    <div class="clear"></div>
  </div>
  <?php } ?>
  
  <?php if($_SESSION['LoginInfo']['USERTYPE']!=null and $_SESSION['LoginInfo']['USERTYPE']==4){?>
  
   <div id="header">
    <div id="top">
      <div class="left"> <a href="<?php echo CreateLinkAdmin(array('index')); ?>"><img src="img/logo.png" /></a> </div>
      <div class="right">
        <div class="align-right">
          <p>Welcome, <strong><?php echo WordLimit($_SESSION['LoginInfo']['USNAME'],4); ?></strong> [ <a href="logouts.php">logout</a> ]</p>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div id="sidebar">
      <div class="box">
        <div class="h_title">&circleddash; Main control</div>
        <ul class="index service_category">
          <li class="b1"><a class="icon view_page" href="<?php echo SITEURL; ?>" target="_blank">Visit Site</a></li>
          <!-- <li class="b1"><a class="icon order" href="<?php echo CreateLinkAdmin(array('report','actions'=>'order')); ?>">View all Orders</a></li>
<li class="b1"><a class="icon add_page" href="<?php echo CreateLinkAdmin(array('cms','actions'=>'add')); ?>">Add New Page</a></li>
<li class="b2"><a class="icon config" href="<?php echo CreateLinkAdmin(array('config')); ?>">Site Config</a></li>
<li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
<li class="b2"><a class="icon category" href="<?php echo CreateLinkAdmin(array('service_category')); ?>">Service Categories</a></li>-->
        </ul>
      </div>


      <div class="box">
        <div class="h_title">&circleddash; Users Management</div>
        <ul class="user supplier both membership member">

        <li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('supplier')); ?>">Vendors</a></li>

        
        <!--<li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('both')); ?>">Buyers/Sellers</a></li>
        <li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('membership')); ?>">Manage Membership</a></li>
        <li class="b1"><a class="icon add_user" href="<?php echo CreateLinkAdmin(array('member')); ?>">Manage Members</a></li>-->
        </ul>
      </div>

      <div class="box">
        <div class="h_title">&circleddash; Profile Settings</div>
        <ul class="config profile password state">
       
          <li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
          <li class="b1"><a class="icon password" href="<?php echo CreateLinkAdmin(array('password')); ?>">Change Password</a></li>
   
        </ul>
      </div>
    </div>
    <div id="main">
      <?php flash(); ?>
      <?php echo $itf_body_contents; ?> </div>
    <div class="clear"></div>
  </div>
  <?php } ?>
  
   
  <?php if($_SESSION['LoginInfo']['USERTYPE']!=null and $_SESSION['LoginInfo']['USERTYPE']==3){?>
  
   <div id="header">
    <div id="top">
      <div class="left"> <a href="<?php echo CreateLinkAdmin(array('index')); ?>"><img src="img/logo.png" /></a> </div>
      <div class="right">
        <div class="align-right">
          <p>Welcome, <strong><?php echo WordLimit($_SESSION['LoginInfo']['USNAME'],4); ?></strong> [ <a href="logouts.php">logout</a> ]</p>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div id="sidebar">
      <div class="box">
        <div class="h_title">&circleddash; Main control</div>
        <ul class="index service_category">
          <li class="b1"><a class="icon view_page" href="<?php echo SITEURL; ?>" target="_blank">Visit Site</a></li>
          <!-- <li class="b1"><a class="icon order" href="<?php echo CreateLinkAdmin(array('report','actions'=>'order')); ?>">View all Orders</a></li>
<li class="b1"><a class="icon add_page" href="<?php echo CreateLinkAdmin(array('cms','actions'=>'add')); ?>">Add New Page</a></li>
<li class="b2"><a class="icon config" href="<?php echo CreateLinkAdmin(array('config')); ?>">Site Config</a></li>
<li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
<li class="b2"><a class="icon category" href="<?php echo CreateLinkAdmin(array('service_category')); ?>">Service Categories</a></li>-->
        </ul>
      </div>


      

      <div class="box">
        <div class="h_title">&circleddash; Profile Settings</div>
        <ul class="config profile password state">
       
          <li class="b1"><a class="icon profile" href="<?php echo CreateLinkAdmin(array('profile')); ?>">Profile Configuration</a></li>
          <li class="b1"><a class="icon password" href="<?php echo CreateLinkAdmin(array('password')); ?>">Change Password</a></li>
   
        </ul>
      </div>
    </div>
    <div id="main">
      <?php flash(); ?>
      <?php echo $itf_body_contents; ?> </div>
    <div class="clear"></div>
  </div>
  <?php } ?>
  <div id="footer">
    <div class="left">
      <p><span text-decoration:underline;>Design & Developed by :</span> <a href="https://maxlence.com.au/" target="_blank">Maxlence.com.au</a> | Admin Panel: <a href=""><?php echo $stieinfo['sitename']; ?></a></p>
    </div>
    <div class="right">
      <p></p>
    </div>
  </div>
</div>
</body>
</html>
