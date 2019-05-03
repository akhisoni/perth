<?php $pagetitle="Home"; ?>
  <?php if($_SESSION['LoginInfo']['USERTYPE']!=null and $_SESSION['LoginInfo']['USERTYPE']==1){?>

<div class="admin_home">
<div class="admin_home_inner">
<div class="addimgbox_r1">
<a target="_blank" href="<?php echo SITEURL; ?>"><img src="img/site.png"></a>
<h1><a target="_blank" href="<?php echo SITEURL; ?>">Site</a></h1>
</div>
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=category"><img src="img/category.png"></a>
<h1><a href="itfmain.php?itfpage=category">Category</a></h1>
</div>
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=events"><img src="img/event.png"></a>
<h1><a href="itfmain.php?itfpage=events">Events</a></h1>
</div>

<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=news"><img src="img/event.png"></a>
<h1><a href="itfmain.php?itfpage=news">News</a></h1>
</div>



<!--<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=discount"><img src="imgs/advertise.png"></a>
<h1><a href="itfmain.php?itfpage=discount">Discount</a></h1>
</div>-->
<!--


<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=banner"><img src="imgs/banner.png"></a>
<h1><a href="itfmain.php?itfpage=banner">Banner Management</a></h1>
</div>-->
<!--<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=advertise"><img src="imgs/advertise.png"></a>
<h1><a href="itfmain.php?itfpage=advertise">Advertise</a></h1>
</div>-->

<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=user"><img src="img/user.png"  title="Users Management"></a>
<h1><a href="itfmain.php?itfpage=user" title="Users Management">Users</a></h1>
</div>
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=supplier"><img src="img/user.png"  title="Members Management"></a>
<h1><a href="itfmain.php?itfpage=supplier" title="Member Management">Members</a></h1>
</div>
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=testimonial"><img src="img/testimonial.png"></a>
<h1><a href="itfmain.php?itfpage=testimonial">Testimonials </a></h1>
</div>


<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=cms"><img src="img/page.png"></a>
<h1><a href="itfmain.php?itfpage=cms">Pages</a></h1>
</div>
<!--<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=banner"><img src="imgs/slider.png"></a>
<h1><a href="itfmain.php?itfpage=banner">App Slider</a></h1>
</div>-->
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=website_banner"><img src="img/news.png"></a>
<h1><a href="itfmain.php?itfpage=website_banner">Web Slider</a></h1>
</div>
<!--<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=help"><img src="imgs/help.png"></a>
<h1><a href="itfmain.php?itfpage=help">Help </a></h1>
</div>-->
<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=config"><img src="img/setting.png"></a>
<h1><a href="itfmain.php?itfpage=config">Settings</a></h1>
</div>

</div>
</div>
<?php } ?>

<?php if($_SESSION['LoginInfo']['USERTYPE']!=null and $_SESSION['LoginInfo']['USERTYPE']==4){?>
<div class="admin_home">
<div class="admin_home_inner">
<div class="addimgbox_r1">
<a target="_blank" href="<?php echo SITEURL; ?>"><img src="imgs/site.png"></a>
<h1><a target="_blank" href="<?php echo SITEURL; ?>">Site</a></h1>
</div>

<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=user"><img src="imgs/users.png"  title="Vendors Management"></a>
<h1><a href="itfmain.php?itfpage=supplier" title="Vendors Management">Vendors</a></h1>
</div>

<div class="addimgbox_r1">
<a href="itfmain.php?itfpage=profile"><img src="imgs/cms.png"></a>
<h1><a href="itfmain.php?itfpage=profile">Settings</a></h1>
</div>

</div>
</div>
<?php } ?>