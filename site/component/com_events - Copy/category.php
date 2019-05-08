<?php $objCategory = new Category();
$categoryinfo = $objCategory->getAllCategoryFront();

$objadvert = new Advertise();
$objadv2 = $objadvert->showAdvertisebyId(3);
$objadv = $objadvert->showAdvertisebyFront();
 ?>




<div class="cateloge-one">

<div id="demo1-html">
<ul id="demo1" class="nav">
<div class="act-top"><h3><img src="<?php echo TemplateUrl();?>image/category-icon.png"/> All Categories</h3></div>
<?php foreach ($categoryinfo as $category){ ?>


	             <li><a href='#'><?php echo $category['catname']; ?></a>
                      
                      <?php if($category['subcat']) {?>
                                <ul>
                                    <?php foreach($category['subcat'] as $subcat) { ?>
                                        <li>
                                                <?php if(!$subcat['subcat']) { ?>
                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subcat['id'])); ?>">
                                                <?php echo $subcat['catname']; ?></a>
                                                <?php } else {?>
                                             <a href="#"> <?php echo $subcat['catname']; ?></a>
<?php } ?>
                                                <?php if($subcat['subcat']) { ?>
                                                    <ul>
                                                        <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                                            <li>
                                                                <?php if(!$subsubcat['subcat']) { ?>
                                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subsubcat['id'])); ?>">
                                                                <?php } ?>

                                                             <?php echo $subsubcat['catname']; ?></a>

                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
      
       
       </li>
    
    <?php } ?>
  </ul>
 
</div>

<div class="fitting">
<br/>
<div class="fitting-valves"> <img src="<?php echo PUBLICPATH."advertise/".$objadv['0']['imagename']; ?>"/> 
      <div class="fltting-elipps"> <img src="<?php echo TemplateUrl();?>image/ellipes.png"/>
        <h2><?php echo $objadv['0']['name']; ?> </h2>
        <a href="<?php echo $objadv['0']['urllink']; ?>"><img src="<?php echo TemplateUrl();?>image/button-black.png"/></a>
         </div></div>
<div class="fitting-valves-anlum">
<img src="<?php echo PUBLICPATH."advertise/".$objadv['1']['imagename']; ?>" />
<div class="fltting-elipps">
<img src="<?php echo TemplateUrl();?>image/ellipes-1.png"/>
<h2><?php echo $objadv['1']['name']; ?></h2>
<a href="<?php echo $objadv['1']['urllink']; ?>"><img src="<?php echo TemplateUrl();?>image/button-view.png"/></a>
</div>
</div>



</div>

</div>

<?php /*?><div class="cateloge-one">

<div id='cssmenu'>
<ul>
   <li class='active'><h1><img src="<?php echo TemplateUrl();?>image/category-icon.png"/> All Categories</h1></li>
 <?php foreach ($categoryinfo as $category){ ?>
 
                     <li class="has-sub"><a href='#'><span><?php echo $category['catname']; ?></span></a>
                      
                      <?php if($category['subcat']) {?>
                                <ul>
                                    <?php foreach($category['subcat'] as $subcat) { ?>
                                        <li class="has-sub">
                                                <?php if(!$subcat['subcat']) { ?>
                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subcat['id'])); ?>">
                                                <?php } else {?>
                                              <a href="#"> <span> <?php echo $subcat['catname']; ?> </span></a>
<?php } ?>
                                                <?php if($subcat['subcat']) { ?>
                                                    <ul>
                                                        <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                                            <li class="has-sub">
                                                                <?php if(!$subsubcat['subcat']) { ?>
                                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subsubcat['id'])); ?>">
                                                                <?php } ?>

                                                               <span> <?php echo $subsubcat['catname']; ?></span></a>

                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
       <?php } ?>
       
       </li>
                
</ul>
</div>

<div class="aluminium">
<div class="fitting-valves-anlum">
<img src="<?php echo PUBLICPATH."advertise/".$objadv2['imagename']; ?>" />
</div>

<div class="fltting-elipps">
<img src="<?php echo TemplateUrl();?>image/ellipes-1.png"/>
<h1><?php echo $objadv2['name']; ?></h1>
<a href="#"><img src="<?php echo TemplateUrl();?>image/button-view.png"/></a>
</div>

</div>

</div><?php */?>



<!--<?php
    Html::AddStylesheet("service/assests/category.css","component");
    //Html::AddJavaScript("service/assests/jquery.min-1.9.js","component");
    Html::AddJavaScript("service/assests/jquery.accordionMenu.js","component");

    $objCategory = new Category();
    $categoryinfo = $objCategory->getAllCategoryFront();

?>


<h3>Category</h3>
<div id="menu">
    <nav>
        <div id="acdnmenu" style="width:235px;height:auto;">

            <ul>
                <?php foreach ($categoryinfo as $category){ ?>
                    <li class='has-sub'>
                        <?php if(!$category['subcat']) { ?>
                            <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$category['id'])); ?>">
                        <?php } ?>
                          <?php echo $category['catname']; ?> </a>

                            <?php if($category['subcat']) { ?>
                                <ul>
                                    <?php foreach($category['subcat'] as $subcat) { ?>
                                        <li class='has-sub'>
                                                <?php if(!$subcat['subcat']) { ?>
                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subcat['id'])); ?>">
                                                <?php } ?>
                                                <?php echo $subcat['catname']; ?> </a>

                                                <?php if($subcat['subcat']) { ?>
                                                    <ul>
                                                        <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                                            <li>
                                                                <?php if(!$subsubcat['subcat']) { ?>
                                                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subsubcat['id'])); ?>">
                                                                <?php } ?>

                                                                <?php echo $subsubcat['catname']; ?></a>

                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<script>
    $(function() {
        $("#acdnmenu").accordionMenu();
    });
</script>-->