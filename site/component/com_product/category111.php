<?php
Html::AddStylesheet("product/assests/category.css","component");
$objCategory = new Category();
$categoryinfo = $objCategory->getAllCategoryFront();

?>
<h3>Category</h3>

<ul class="accordion" style="display: none;">
    <?php foreach ($categoryinfo as $category){ ?>
        <li>
            <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail&id='.$category['id'].'#'.seoLink($category['catname']).''    )); ?>"><?php echo $category['catname']; ?></a>
            <ul>
                <?php foreach($category['subcat'] as $subcat) { ?>
                    <li>
                        <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail&id='.$subcat['id'].'#'.seoLink($category['catname']).'-'.seoLink($subcat['catname'].' '))); ?>"><?php echo $subcat['catname']; ?></a>
                        <ul>
                            <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                <li>
                                    <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail&id='.$subsubcat['id'].'#'.seoLink($category['catname']).'-'.seoLink($subcat['catname'].' '))); ?>"><?php echo $subsubcat['catname']; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>

        </li>
    <?php } ?>
</ul>

<div id='cssmenu'>
    <ul>
        <?php foreach ($categoryinfo as $category){ ?>
            <li class='has-sub'>
                <?php if(count($category['subcat']) > 0) { ?>
                    <a href="<?php echo CreateLink(array('product','parent'=>$category['id'] )); ?>">
                <?php } else { ?>
                    <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$category['id'])); ?>">
                <?php } ?>
                    <?php echo $category['catname']; ?></a>

                <?php if($category['subcat']) { ?>
                <ul>
                    <?php foreach($category['subcat'] as $subcat) { ?>
                        <li class='has-sub'>

                            <?php if(count($subcat['subcat']) > 0) { ?>
                                <a href="<?php echo CreateLink(array('product','parent'=>$subcat['id'] )); ?>">
                            <?php } else { ?>
                                <a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$subcat['id'])); ?>">
                             <?php } ?>
                                <?php echo $subcat['catname']; ?></a>
                            <?php if($subcat['subcat']) { ?>
                            <ul>
                                <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                    <li>
                                        <?php if(count($subsubcat['subcat']) > 0) { ?>
                                            <a href="<?php echo CreateLink(array('product','parent'=>$subsubcat['id'] )); ?>">
                                        <?php } else { ?>
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