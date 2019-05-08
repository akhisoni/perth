<?php
$objProduct = new Product();
$objCategory = new Category();
$id = isset($_GET['id'])?$_GET['id']:'';

$perpage = $stieinfo['front_paging_size'] ;
$urlpath = CreateLink(array($currentpage,'itemid'=>'catdetail&id='.$id))."&";

if(isset($_REQUEST['res']) && !empty($_REQUEST['res'])){
	//echo "akhi";
$InfoData1 = $objProduct->getProductByAlphabet($id,$_REQUEST['res']);

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

$objcms = new PageCms();
$cms= $objcms->GetPageData(14);
$itfMeta=array("title"=>$catinfo["pagetitle"],"description"=>$catinfo["pagemetatag"],"keyword"=>$catinfo["pagekeywords"]);

?>



<section class="section">
<div class="center_main">
<div class="home"><a href="<?php echo SITEURL; ?>">Home</a> / <a href="<?php echo CreateLink(array('product')); ?>"><span>Product</span></a> <span><?php echo $breadcrumb; ?></span></div>

  <?php include('category.php'); ?>
<div class="main-about">
<div class="about-one">
<h1>Catalogues Details <br/> <img src="<?php echo TemplateUrl();?>image/line-sm.png"/></h1> 
<?php echo $cms['logn_desc'];?>


<div class="sort_by">
<div class="companny_name">
<ul>
<li>Select by Company Name:</li>
<li><a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$id,'res'=>'0-9' )); ?>">0-9</a></li>

<?php
   for ($row=1; $row <= 1; $row++)
      foreach (range('A','Z') as $column){
       
   
?>

<li><a href="<?php echo CreateLink(array('product','itemid'=>'catdetail','id'=>$id,'res'=>$column )); ?>"><?php echo "$column"; ?></a></li>
<?php }?>

</ul>

</div>


</div>

<ul class="all_product">

<?php if(count($products) > 0) { ?>
            <?php foreach ($products as $product){ ?>
      
          
        
            
<li class="product_listing">
<div class="cat_left"> <a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>">
                            <?php if(file_exists(PUBLICFILE."/products/".$product['main_image']) && !empty($product['main_image'])) { ?>
                            <img src="<?php echo PUBLICPATH."/products/".$product['main_image']; ?>" width="155px;" height="188px;" alt=""></a>
                        <?php } else { ?>
                            <img src="<?php echo PUBLICPATH."/products/noimage.jpg"; ?>"  width="155px;" height="188px;" alt=""></a>
                        <?php } ?></div>
<div class="cat_right">
<h1 class="cat_title"><?php echo $product['name']; ?></h1>
<div class="list_page"><?php echo $product['pdf_page']; ?> Pages</div>
<p><?php echo substr($product['logn_desc'],0,150); ?>
</p>
<div class="seller_logo"> <!--<a href="#"><img src="<?php echo TemplateUrl();?>image/product-logo.png" style="margin-top:5px;"/></a>--></div>

<a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>" class="button_catalogue">View Catalogue</a></div>
<div class="btm_bdr"></div>
</li>
      <?php } ?>
  <?php } else { ?>
            <div class="" style="text-align: center;"><p>No Products in this category.</p> </div>
            <?php } ?>
</ul>
<div class="product_rgt_top">
            <?php echo $pagingobj->Pages(); ?>

        </div>
</div>
</div>

</div>

</section>



















<?php /*?>
    
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
        <div class="product_rgt_top"  class="register-inpt"  style="width: 100px; height:22px; color:#143e7e;">
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
</script><?php */?>