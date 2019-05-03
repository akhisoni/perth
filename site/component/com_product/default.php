<?php
$objProduct = new Product();
$objCategory = new Category();
$id = isset($_GET['id'])?$_GET['id']:'';

$perpage = 12;

if (isset($_REQUEST['sortby']))
 {
  $sortby = $_REQUEST['sortby'];
  if ($sortby == 'pricehigh') {
$InfoData1=$objProduct->getProductByCategoryBySort($id,$sortby);
$urlpath = CreateLink(array($currentpage.'&id='.$id.'&sortby='.$_REQUEST['sortby']))."&";
   }
  elseif ($sortby == 'pricelow') {
$InfoData1=$objProduct->getProductByCategoryBySort($id,$sortby);
$urlpath = CreateLink(array($currentpage.'&id='.$id.'&sortby='.$_REQUEST['sortby']))."&";
     }
  elseif ($sortby == 'newest') {
$InfoData1=$objProduct->getProductByCategoryBySort($id,$sortby);
$urlpath = CreateLink(array($currentpage.'&id='.$id.'&sortby='.$_REQUEST['sortby']))."&";
  }
}else {
	$InfoData1 = $objProduct->getProductByCategory($id);
$urlpath = CreateLink(array($currentpage.'&id='.$id))."&";
	}



$pagingobj = new ITFPagination($urlpath,$perpage);
$products = $pagingobj->setPaginateData($InfoData1);

$catinfo = $objCategory->CheckCategory($id);
//echo"<pre>"; print_r($pagingobj); die;

$breadcrumb = $objCategory->getBreadcum($id);

$sortorder = array('name'=>'Name','id'=>'Newest');
$sort = isset($_POST['sort'])?$_POST['sort']:'';



?>



<!--center start-->
<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li><a href="<?php echo CreateLink(array('product','id'=>$id)); ?>"><?php echo $breadcrumb; ?></a></li>
    
  
  </ul>
</div>
<div class="bred-inner">
  <h1><?php echo $catinfo['catname'];?> </h1>
  <p class="result">Results for cars 1 - 10 of 18</p>
  <div class="sort"> <select name="menu2" id="menu2">
          <option value="<?php echo CreateLink(array("product","id"=>$id,"sortby"=>'newest')); ?>" <?php if($sortby == 'newest'){ echo 'selected';}?>>New Listed</option>
          <option value="<?php echo CreateLink(array("product","id"=>$id,"sortby"=>'pricelow')); ?>" <?php if($sortby == 'pricelow'){ echo 'selected';}?>>Lowest price list</option>
          <option value="<?php echo CreateLink(array("product","id"=>$id,"sortby"=>'pricehigh')); ?>" <?php if($sortby == 'pricehigh'){ echo 'selected';}?>>Highest price list</option>
        </select></div>
</div>
</div>

<div class="listing">
<div class="row">



<?php if(count($products) > 0) { ?>
            <?php foreach ($products as $product){
		$imge = unserialize($product['image']);
		$objloc = $objProduct->GetLocationName($product['location']);

				 ?>
      
          
<div class="cm-4">
  <div class="box-inner">
  <div class="white-box">
    <p class="img-box"><a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>"> <?php if(file_exists(PUBLICFILE."/products/".$imge[0]) && !empty($imge[0])) { ?>
                            <img src="<?php echo PUBLICPATH."/products/".$imge[0]; ?>" width="252px;" height="176px;" alt=""></a>
                        <?php } else { ?>
                            <img src="<?php echo PUBLICPATH."/products/noimage.jpg"; ?>"  width="155px;" height="188px;" alt=""></a>
                        <?php } ?></a></p>
    <p class="box-head"><a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$product['id'])); ?>"><?php echo Wordlimit($product['name'],4); ?></a></p>
    <p class="no12"><a href="#"> <?php echo date("j M, Y", strtotime(date($product['entrydate'])) );?>   l <?php echo $objloc['name']; ?></a></p>
        <p class="aud"><?php if($product['price']=='0'){
                  if($product['opt_price']=='2') echo "Free";
				   if($product['opt_price']=='3') echo "Please contact";
				   if($product['opt_price']=='4') echo "Swap / Trade ";
				  
				  ?>
                  <?php }else {?>
					  AUD <?php echo $product['price'];
					  ?>
                  <?php }?></p>
    <a href="<?php echo CreateLink(array('reply','id'=>$product['id'])); ?>" class="view-d">Reply</a>
  </div>
  </div>
</div>
  
      <?php } ?>
  <?php } else { ?>
            <div class="" style="text-align: center;"><p>No Products in this category.</p> </div>
            <?php } ?>
</div>

<div class="cnetr121">
<div class="pagination-fo">
<?php echo $pagingobj->Pages(); ?>

</div>
</div>

</div>

</div>
</div>
<!--center end-->



<script type="text/javascript">
 var urlmenu = document.getElementById( 'menu2' );

 urlmenu.onchange = function() {
      window.open( this.options[ this.selectedIndex ].value, '_self');
 };
</script> 