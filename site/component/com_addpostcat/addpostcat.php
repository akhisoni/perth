<?php
$categoryobj=new Category();
$allcat=$categoryobj->getAllActiveCat();

?>

<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li>Select a category</a></li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Select a category</h1>
  </div>
  
<div class="inner_content">
<div class="post_cont_left post_container">
	
        <?php foreach($allcat as $allcatval){?>
			<div class="adsinner <?php echo $allcatval['slug']; ?>">
					<h3><?php echo $allcatval['catname']; ?></h3>
					<ul>
		<?php
			$allsubcat=$categoryobj->getAllActiveSubCat($allcatval['id']);
			foreach($allsubcat as $subcat){
        ?>
    <li><a href="<?php echo CreateLink(array("postad",'catid'=>$allcatval['id'],'subid'=>$subcat['id'])); ?>" class="post_button"><?php echo $subcat['catname'];?></a></li>
					<?php } ?>
					</ul>
			</div>	
		<?php } ?>				
	</div>
</div>
</div>
</div>
</div>






</div>