<?php

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Homepage css-->
    <link rel="stylesheet" href="<?php echo TemplateUrl();?>css/home.css">
    <!-- Slick css-->
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>slick/slick-theme.css">
    <!-- Font Awesome Css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Google Font-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo TemplateUrl();?>fonts">
    
</head>

<body>
    <?php flashMsg(); ?>
<?php  echo itf_modules("header"); ?>
  
    <!--Navebar Start-->
    
    <!--Navebar End-->
    <!-- Section 1 Carousel Home Start-->
    <?php echo $itf_bodydata; ?>
    <!-- Footer Section -->
    <?php  echo itf_modules("footer"); ?>
    
    
    <!-- Javascript Files -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>