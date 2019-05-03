<?php 

die;

$objpages = new PageCms();
$pagemenus = $objpages->GetMenuCms();

if(empty($itfMeta["title"])){
$itfMeta = array("title"=>"Home","description"=>"Find best Aluminium Sheet Suppliers in Melbourne, Brisbane, Perth, Sydney and Adelaide. Complete Aluminium Suppliers & Stainless Steel Suppliers directory","keyword"=>"aluminium sheet, aluminium extrusion, aluminium suppliers, aluminium sheet suppliers,  window manufacturers, aluminium sections, aluminium plate, aluminium tread plate, aluminium windows,  aluminium suppliers melbourne, steel suppliers, stainless steel suppliers");

}

$quote = new Quote();
$quote_info = $quote->getTotalQuote();
$user = new User();
$user_id = isset($_SESSION['FRONTUSER']['id'])?$_SESSION['FRONTUSER']['id']:'';
$userinfo = $user->getUserInfo($user_id);

?>

<!doctype html>
<html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords" content="<?php echo $itfMeta['keyword']; ?>">
             <meta name="description" content="<?php echo $itfMeta['description']; ?>">
            <title><?php echo $itfMeta['title']." | ".$stieinfo["sitename"]; ?></title>
   

<link rel="stylesheet" href="<?php echo TemplateUrl();?>css/style.css">
<link rel="stylesheet" href="<?php echo TemplateUrl();?>css/responsive.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo TemplateUrl();?>css/flexslider.css" type="text/css" media="screen" />
 <script src="<?php echo TemplateUrl();?>js/jquery-1.9.1.min.js"></script>
<script defer src="<?php echo TemplateUrl();?>js/jquery.flexslider.js"></script>
<script defer src="<?php echo TemplateUrl();?>js/main.js"></script>


            
            
<body>

<?php flashMsg(); ?>
<?php  echo itf_modules("header"); ?>
<?php echo $itf_bodydata; ?>
<?php  echo itf_modules("footer"); ?>
</body>
</html>
