<?php
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
</script>