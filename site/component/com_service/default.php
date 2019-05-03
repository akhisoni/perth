<?php
    $services = new ServiceCategory();

    $parent = isset($_GET['parent'])?$_GET['parent']: 0;
    $perpage = $stieinfo['front_paging_size'] ;
    $urlpath = CreateLink(array($currentpage,))."&";
    $InfoData1 = $services->getCategories($parent);
    $pagingobj = new ITFPagination($urlpath,$perpage);
    $InfoData = $pagingobj->setPaginateData($InfoData1);

//echo"<pre>"; print_r($suppliers); die;

?>

<div class="main_mat">
    <p><a href="<?php echo SITEURL; ?>">Home</a> / <a href="<?php echo CreateLink(array('service')); ?>">Services</a></p>
</div>
<div class="about_us"><h3>Services</h3></div>

<div class="product_lft">
    <?php  require_once('category.php');?>
</div>
<div class="product_rgt">
    <div class="pro_cate">
        <?php foreach ($InfoData as $info){  ?>
            <div class="pro_cate_cont">
                <?php if(count($info['subcat']) > 0) { ?>
                <a href="<?php echo CreateLink(array('service','parent'=>$info['id'])); ?>">
                    <?php } else { ?>
                    <a href="<?php echo CreateLink(array('service','itemid'=>'catdetail','id'=>$info['id'])); ?>">
                        <?php } ?>

                        <?php if(!empty($info['image']) and file_exists(PUBLICFILE."categories/".$info['image'])) { ?>
                        <img src="<?php echo PUBLICPATH."categories/".$info['image']; ?>" width="120px" height="122px" alt=""></a>
                    <?php } else { ?>
                    <img src="<?php echo PUBLICPATH."categories/noImageProduct.jpg"; ?>" width="120px" height="122px" alt=""></a>
            <?php } ?>
                <p>
                    <?php if(count($info['subcat']) > 0) { ?>
                    <a href="<?php echo CreateLink(array('service','parent'=>$info['id'])); ?>">
                    <?php } else { ?>
                    <a href="<?php echo CreateLink(array('service','itemid'=>'catdetail','id'=>$info['id'])); ?>">
                    <?php } ?>

                    <?php echo $info['catname']; ?></a></p>
            </div>
        <?php } ?>

        <div class="clear"></div>
    </div>
    <div class="product_rgt_top">
        <?php echo $pagingobj->Pages(); ?>
    </div>

</div>