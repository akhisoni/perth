<?php 
mb_internal_encoding("8bit");
$msgs="";
require('../itfconfig.php');
$currentpage = isset($_GET['itfpage']) ? $_GET['itfpage']:'login';
ob_start();
	include("module/mod_forgot/".$currentpage.".php");
$bodypage  = ob_get_contents();
ob_clean();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo $stieinfo['sitename'].' | Admin Panel'; ?></title>
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
    <script language="javascript" src="js/jquery.js"></script>
    <script language="javascript" src="js/jquery.validate.js"></script>  
      
</head>
<body>
<div class="wrap">
    <div id="content">
        <div class="logo"><img src="img/logo.png" width="170px" height="170px" /></div>
        <div id="main">
            <?php flash(); ?>
            <div class="full_w">
                <?php echo $bodypage;  ?>
            </div>
            <div class="copytight">Copyright © 2018 - <?php echo $stieinfo['sitename']; ?> Admin Panel | Powered by: <a href="https://maxlence.com.au/" target="_blank">Maxlence.com.au</a></div>	
           <!-- <div class="footer">&raquo; <a href=""><?php echo $stieinfo['sitename']; ?></a> | Admin Panel</div>-->
        </div>
    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function()
    {
        $(".close").click(function(){ $(".msg").remove(); });

    });

</script>