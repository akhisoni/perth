<?php
    $objCategory = new ServiceCategory();
    $id = isset($_GET['id'])?$_GET['id']:'';
    $perpage = $stieinfo['front_paging_size'] ;
    $urlpath = CreateLink(array($currentpage,'itemid'=>'catdetail&id='.$_GET['id']))."&";
    $InfoData1 = $obj->showAllSuppliers($_GET['id']);
     $pagingobj = new ITFPagination($urlpath,$perpage);
     $breadcrumb = $objCategory->getBreadcum($id);
    $suppliers = $pagingobj->setPaginateData($InfoData1);
    $catinfo = $objCategory->CheckCategory($_GET['id']);
    
?>

<div class="main_mat">
<p><a href="<?php echo ITFPATH; ?>">Home</a> / <a href="<?php echo CreateLink(array('service')); ?>">Services</a>  <?php echo $breadcrumb; ?></p>
</div>

<div class="about_us"><h3>Services</h3></div>
    <div class="product_lft">
        <?php include('category.php'); ?>
    </div>
    <div class="product_rgt">

        <div class="services">
            <?php foreach($suppliers as $supplier) { 
			
			
			?>
               
               
                <div class="services_cont">
                   <a onclick="servicedas();"> <img src="<?php echo PUBLICPATH."/profile/"; ?><?php if($supplier['profile_image']){ echo $supplier['profile_image'];} else { echo 'no_image.jpg'; }; ?>">
                    <p><span><?php echo $supplier['name']." ".$supplier['last_name']; ?></span> <br><?php echo $supplier['email']; ?></p></a>
                </div>
            <?php } ?>

            <div class="clear"></div>
        </div>

        <div class="product_rgt_top">
            <?php echo $pagingobj->Pages(); ?>

        </div>
        

    </div> 
<script>
  function servicedas(){
alert("you have to use Custom Quote to contact these Service Providers");
 window.location=("<?php echo CreateLink(array('dashboard#tab2')); ?>");        
          
       
              
         
       
    }
    </script>