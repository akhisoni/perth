<?php 
$objcontents=new PageCms();
if(isset($_POST["emailid"],$_POST["name"]))
{
	$objcontents->contactUs($_POST);
	$gotolink=CreateLink(array("contents","itemid"=>"thanks"));
	redirectUrl($gotolink);
}
$contentdata=$objcontents->GetArticales($data["itemid"]);
$itfMeta=array("title"=>$contentdata["pagetitle"],"description"=>$contentdata["pagemetatag"],"keyword"=>$contentdata["pagekeywords"]);


?>


<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li><?php echo $contentdata["pagetitle"]; ?></a></li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1><?php echo $contentdata["pagetitle"]; ?></h1>
  </div>
  
<div class="inner_content">
<?php if(!empty($contentdata)) { ?>
 <?php echo $contentdata["logn_desc"]; ?>
</div>
<?php } else { ?>
    <div class="inner_content" style="text-align: center;">No Page Found !</div>
<?php } ?>
</div>
</div>






</div>