<?php $objCategory = new Category();
$categoryinfo = $objCategory->getAllCategoryFront();

$objadvert = new Advertise();
$objadv = $objadvert->showAdvertisebyFront();
$objadv2 = $objadvert->showAdvertisebyId(3);
$objadv3 = $objadvert->showAdvertisebyId(4); ?>
<div class="cateloge-one">
<!--<div id="demo1-html">
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
 
</div>-->

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
