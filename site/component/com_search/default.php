<?php
    if(isset($_POST["txt_search"])) {
        $_SESSION["SEARCHDATA"]= $_POST;
    }else{
        $_POST = $_SESSION["SEARCHDATA"];
    }



if(isset($_REQUEST['res']) && !empty($_REQUEST['res'])){
	//echo "akhi";
	
	

            $perpage = isset($stieinfo['front_paging_size'])?$stieinfo['front_paging_size']:'14' ;
            $urlpath = CreateLink(array($currentpage))."&";
            $InfoData1 = $objProduct->getProductByAlphabetSearch($_REQUEST['res']);
            $count = count($InfoData1);
            $pagingobj = new ITFPagination($urlpath,$perpage);
            $searchproducts = $pagingobj->setPaginateData($InfoData1);

        


}else{
	
	 if(isset($_POST["txt_search"]))
    {

        if(!empty($_POST["txt_search"]) && $_POST["txt_search"] != 'Search here'){

            $perpage = isset($stieinfo['front_paging_size'])?$stieinfo['front_paging_size']:'14' ;
            $urlpath = CreateLink(array($currentpage))."&";
            $InfoData1 = $objProduct->search($_POST["txt_search"]);
            $count = count($InfoData1);
            $pagingobj = new ITFPagination($urlpath,$perpage);
            $searchproducts = $pagingobj->setPaginateData($InfoData1);

        } else {
            flashMsg("Please enter text for search product","2");
            redirectUrl(CreateLink(array("index")));
        }
    } else {

        redirectUrl(CreateLink(array("index")));
    }

}
   


?>

<section class="section">



<div class="center_main">
<div class="home"><a href="<?php echo SITURL; ?>">Home</a> / <span>Search Results</span></div>

 <?php include('category.php'); ?>
<div class="main-about">
<div class="about-one">
<h1>Catalogues Search Details <br/> <img src="<?php echo TemplateUrl();?>image/line-sm.png"/></h1> 
<p>Below you will find a count of manufacturers for products and services related to MasterFormat 01 - General Requirements. To find out more detailed information about manufacturers listed in the division,click on the section links to locate company and product information....</p>


<div class="sort_by">
<div class="companny_name">
<ul>
<li>Select by Company Name:</li>
<li><a href="<?php echo CreateLink(array('search','res'=>'0-9' )); ?>">0-9</a></li>

<?php
   for ($row=1; $row <= 1; $row++)
      foreach (range('A','Z') as $column){
?>
<li><a href="<?php echo CreateLink(array('search','res'=>$column )); ?>"><?php echo "$column"; ?></a></li>
<?php }?>

</ul>

</div>


</div>

<ul class="all_product">

 <?php if(count($searchproducts) > 0 ) { ?>
           <?php foreach ($searchproducts as $product){  ?>
      <li class="product_listing">
<div class="cat_left"> 
<a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>">
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
<!--<div class="seller_logo"> <a href="#"><img src="<?php echo TemplateUrl();?>image/product-logo.png" style="margin-top:5px;"/></a></div>-->

<a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>" class="button_catalogue">View Catalogue</a></div>
<div class="btm_bdr"></div>
</li>
      <?php } ?>
  <?php } else { ?>
            <div class="" style="text-align: center;"><p>No Catalogue Found.</p> </div>
            <?php } ?>
</ul>
</div>

 <?php echo $pagingobj->Pages(); ?>
</div>


</div>


</section>
<?php /*?>
<div class="main_mat">
    <p><a href="<?php echo ITFPATH; ?>">Home</a> / <a href="">Search Results</a></p>
</div>

<div class="product_rgt search_result">

    <?php if(count($searchproducts) > 0 ) { ?>
    <p><?php echo $count; ?> records found matching with "<span style="color: #0000AF;"><?php echo $_POST["txt_search"]; ?></span>" . </p>
    <div class="product_rgt_top">
        <?php echo $pagingobj->Pages(); ?>
    </div>
    <div class="pro_cate">
        <?php foreach ($searchproducts as $product){  ?>
            <div class="pro_cate_cont"> <a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>">
                    <?php if(file_exists(PUBLICFILE."/products/".$product['main_image'])) { ?>
                    <img src="<?php echo PUBLICPATH."/products/".$product['main_image']; ?>" width="120px" height="122px" alt=""></a>
                <?php } else { ?>
                    <img src="<?php echo PUBLICPATH."/products/noImageProduct.jpg"; ?>" width="120px" height="122px" alt=""></a>
                <?php } ?>
                <p><a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>"><?php echo $product['name']; ?></a></p>
            </div>
        <?php } ?>

        <div class="clear"></div>
    </div>

    <?php } else { ?>
        <p style="text-align: center; margin-top: 50px;">No record found matching with "<span style="color: #0000AF;"><?php echo $_POST["txt_search"]; ?></span>" !</p>
    <?php } ?>
</div><?php */?>