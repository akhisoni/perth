<?php 
$objpages = new PageCms();
$pagemenus = $objpages->GetMenuCms();

if(empty($itfMeta["title"])){
$itfMeta = array("title"=>"Home","description"=>"Creaseart","keyword"=>"Washing");

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
            <meta charset="utf-8">
    <!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords" content="<?php echo $itfMeta['keyword']; ?>">
             <meta name="description" content="<?php echo $itfMeta['description']; ?>">
            <title><?php echo $itfMeta['title']." | ".$stieinfo["sitename"]; ?></title>
            <link rel="shortcut icon" href="<?php echo TemplateUrl();?>images/favicon.png">
   

 <link href="<?php echo TemplateUrl();?>external/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?php echo TemplateUrl();?>fonts/style.css" rel="stylesheet">
    <link href="<?php echo TemplateUrl();?>external/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo TemplateUrl();?>external/slick/slick.css" rel="stylesheet">
    <link href="<?php echo TemplateUrl();?>external/slick/slick-theme.css" rel="stylesheet">
    <link href="<?php echo TemplateUrl();?>css/style.css" rel="stylesheet">
    
    <link href="<?php echo TemplateUrl();?>css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
    <!-- Fontawesoem icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>external/revolution/css/settings.css">
    <!-- REVOLUTION LAYERS STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>external/revolution/css/layers.css">
    <!-- REVOLUTION NAVIGATION STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>external/revolution/css/navigation.css">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131267437-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131267437-1');
</script>


</head>
            
            
<body>

<?php flashMsg(); ?>
<?php  echo itf_modules("header"); ?>
<?php echo $itf_bodydata; ?>
<?php  echo itf_modules("footer"); ?>
</body>
</html>
