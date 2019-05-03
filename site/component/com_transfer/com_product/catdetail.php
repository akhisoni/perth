<?php
    $objProduct = new Product();
    $objCategory = new Category();
    $id = isset($_GET['id'])?$_GET['id']:'';

    $perpage = $stieinfo['front_paging_size'] ;
    $urlpath = CreateLink(array($currentpage,'itemid'=>'catdetail&id='.$id))."&";

    if(isset($_POST['sort']) && !empty($_POST['sort'])){
        $InfoData1 = $objProduct->getProductByCategory($id,$_POST['sort']);

    }else{
        $InfoData1 = $objProduct->getProductByCategory($id);
    }
    $pagingobj = new ITFPagination($urlpath,$perpage);
    $products = $pagingobj->setPaginateData($InfoData1);
    $catinfo = $objCategory->CheckCategory($id);
    //echo"<pre>"; print_r($pagingobj); die;

    $breadcrumb = $objCategory->getBreadcum($id);

    $sortorder = array('name'=>'Name','id'=>'Newest');
    $sort = isset($_POST['sort'])?$_POST['sort']:'';

?>

<div class="main_mat">
<p><a href="<?php echo ITFPATH; ?>">Home</a> / <a href="<?php echo CreateLink(array('product')); ?>">Product</a> <?php echo $breadcrumb; ?></p>
</div>
    <div class="product_lft">
        <?php include('category.php'); ?>
    </div>
    <div class="product_rgt">
        <?php if(count($products) > 0) { ?>
        <div class="product_rgt_top1">
            <div class="sort">
             <form id="frmsort" name="sort" method="post" action="" >
                <label>Sort:</label>
                 <?php echo HTML::ComboBox('sort',$sortorder,$sort,array(),'Select'); ?>
             </form>
            </div>

        </div>
        <?php }?>
        <div class="product_rgt_top">
            <?php echo $pagingobj->Pages(); ?>
        </div>
        <div class="pro_cate">
            <?php if(count($products) > 0) { ?>
            <?php foreach ($products as $product){ ?>
                    <div class="pro_cate_cont"> <a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>">
                            <?php if(file_exists(PUBLICFILE."/products/".$product['main_image']) && !empty($product['main_image'])) { ?>
                            <img src="<?php echo PUBLICPATH."/products/".$product['main_image']; ?>" width="120px" height="122px" alt=""></a>
                        <?php } else { ?>
                            <img src="<?php echo PUBLICPATH."/products/noImageProduct.jpg"; ?>" width="120px" height="122px" alt=""></a>
                        <?php } ?>
                        <p><a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>"><?php echo $product['name']; ?></a></p>
                    </div>
            <?php } ?>
            <?php } else { ?>
            <div class="" style="text-align: center;"><p>No Products in this category.</p> </div>
            <?php } ?>
        
            <div class="clear"></div>
        </div>
        <div class="product_rgt_top">
            <?php echo $pagingobj->Pages(); ?>

        </div>
        

    </div>

<script>
    $(function(){

        $('#sort').change(function() {
            $('#frmsort').submit();
        });

    });
</script>