<?php
$objProduct = new Events();
$objCategory = new Category();
$id = isset($_GET['catid'])?$_GET['catid']:'';

$perpage = 20;

if (isset($_REQUEST['catid']))
 {
 
$InfoData1=$objProduct->getProductByCategoryBySort($id,$sortby);
$urlpath = CreateLink(array($currentpage.'&catid='.$id))."&";
   }

else {
	$InfoData1 = $objProduct->ShowAllEventlist();
$urlpath = CreateLink(array($currentpage))."&";
	}



$pagingobj = new ITFPagination($urlpath,$perpage);
$products = $pagingobj->setPaginateData($InfoData1);

$catinfo = $objCategory->CheckCategory($id);
//echo"<pre>"; print_r($pagingobj); die;

$breadcrumb = $objCategory->getBreadcum($id);

$sortorder = array('name'=>'Name','id'=>'Newest');
$sort = isset($_POST['sort'])?$_POST['sort']:'';

$catlist = $objCategory->getSupCategories();

$user = new User();


?>

<section>
    <div class="banner">
        <img src="<?php echo TemplateUrl();?>images/about_us_banner.png" alt="Snow" style="width:100%;">
        <div class="text-center">
            <div class="about-right text-center">
                <div class="text-center">
                    <img src="<?php echo TemplateUrl();?>images/decorline.png">
                    <div class="abouttext">
                        <h4>Events</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container eventtypesection">
        <div class="bg-danger text-center eventtype">
            <div class="next">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Category
                    <span class="caret"></span></button>
                <ul class="dropdown-menu eventdetailsmenu">
                    
                    <li><a href="<?php echo CreateLink(array('events')); ?>">Select Category</a></li>
                    <?php foreach($catlist as $catlist1) {?>
                    <li><a href="<?php echo CreateLink(array('events','catid'=>$catlist1['id'])); ?>"><?php echo $catlist1['catname']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
    </div>
    
    <div class="container">
        <div class="card-deck cardrow eventdetails">
            
            <?php if(count($products) > 0) { ?>
            <?php foreach ($products as $product){
		 $imge = explode(',',$product['image']);
		$username = $user->CheckProfileIDUser($product['seller_id']);

				 ?>
      
            <div class="col-md-3">
            <div class="card" style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.16);">
                <div class="eventimg">
                    <a href="<?php echo CreateLink(array('events','itemid'=>'detail&id='.$product['id'])); ?>"> <img class="card-img-top" src="<?php echo PUBLICPATH."/event_images/".$imge[0]; ?>" alt="Card image cap" /></a>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="<?php echo CreateLink(array('events','itemid'=>'detail&id='.$product['id'])); ?>"><?php echo $product['event_name']; ?></a></h5>
                    <span><i class="fas fa-user-friends"></i><?php echo $username['name']; ?></span>
                    <div>
                        <span><i class="far fa-calendar-alt"></i> <?php echo $product['start_date']; ?></span>
                        <span><i class="fas fa-clock"></i><?php echo $product['start_time']; ?></span>
                    </div>
                    <span><i class="fas fa-map-marker-alt"></i><?php echo $product['address']; ?></span>
                </div>
            </div></div>
            
             
            
            
            
            <?php } ?>
  <?php } else { ?>
            <div class="col-md-3" style="text-align: center;"><p>No Events in this category.</p> </div>
            <?php } ?>
                        
                        
                    </div>
    </div>


    
    






<?php echo $pagingobj->Pages(); ?>




    
    
</section>





<style>.col-md-3 { padding:0px !important; margin-bottom:25px;}

.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle { background-color: #fff;
    }
    .btn-primary:hover {
    color: #000 !important;
    background-color: #fff !important;
    border-color: #000 !important;
}
    
    
    .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show>.btn-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 0.2rem #f2f2f2 !important;
}
.btn-primary.focus, .btn-primary:focus {
    box-shadow: 0 0 0 0.2rem #f2f2f2 !important;
}
    
    .btn-primary {
    color: #000 !important;
    
    }
    .eventdetailsmenu a {color: #000; text-decoration: none; padding: 15px;}
</style>