<?php

if (isset($_REQUEST['cat_id']) or ($_REQUEST['name']) or  ($_REQUEST['location']) or ( $_REQUEST['name']))
 {
   $products = $objProduct->getAllRecordMainsearch($_REQUEST);
   $urlpath = CreateLink(array($currentpage))."&";
 }else {
	 $products = $objProduct->ShowAllProductFrontend();
	 $urlpath = CreateLink(array($currentpage))."&";
	 
	 }
$perpage = 12 ;

if (isset($_REQUEST['sortby']))
 {
  $sortby = $_REQUEST['sortby'];
  if ($sortby == 'pricehigh') {
$products =$objProduct->getProductBySearchBySort($sortby);
$urlpath = CreateLink(array($currentpage.'&sortby='.$_REQUEST['sortby']))."&";
   }
  elseif ($sortby == 'pricelow') {
$products=$objProduct->getProductBySearchBySort($sortby);
$urlpath = CreateLink(array($currentpage.'&sortby='.$_REQUEST['sortby']))."&";
     }
  elseif ($sortby == 'newest') {
$products=$objProduct->getProductBySearchBySort($sortby);
$urlpath = CreateLink(array($currentpage.'&sortby='.$_REQUEST['sortby']))."&";
  }
}else {
	
	}

	 

$pagingobj = new ITFPagination($urlpath,$perpage);
$products = $pagingobj->setPaginateData($products);

?>


<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li><a href="<?php echo CreateLink(array('product','id'=>$id)); ?>">Search Result</a></li>
    
  
  </ul>
</div>
<div class="bred-inner">
  
  <p class="result">Results: 1 - 10 of 18</p>
  <div class="sort">Sort By:<select name="menu2" id="menu2">
          <option value="<?php echo CreateLink(array("advance_search_result","sortby"=>'newest')); ?>" <?php if($sortby == 'newest'){ echo 'selected';}?>>New Listed</option>
          <option value="<?php echo CreateLink(array("advance_search_result","sortby"=>'pricelow')); ?>" <?php if($sortby == 'pricelow'){ echo 'selected';}?>>Lowest price list</option>
          <option value="<?php echo CreateLink(array("advance_search_result","sortby"=>'pricehigh')); ?>" <?php if($sortby == 'pricehigh'){ echo 'selected';}?>>Highest price list</option>
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
            <div class="" style="text-align: center;"><p>No Products Found</p> </div>
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
</div>

<script type="text/javascript">
 var urlmenu = document.getElementById( 'menu2' );

 urlmenu.onchange = function() {
      window.open( this.options[ this.selectedIndex ].value, '_self');
 };
</script> 