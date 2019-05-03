<link href="<?php echo TemplateUrl(); ?>css/cateloge-style.css" rel="stylesheet" type="text/css"/>
<?php
$objCategory = new Category();
$categoryinfo = $objCategory->getAllCategoryFront()
?>




<!--<div class="product_lft">
    <h3>Category</h3>
    <ul>
        <?php foreach ($categoryinfo as $category){ ?>
            <li><a href="<?php echo CreateLink(array('product','itemid'=>'catdetail&id='.$category['id'])); ?>"><?php echo $category['catname']; ?></a></li>
        <?php } ?>
    </ul>
</div>-->