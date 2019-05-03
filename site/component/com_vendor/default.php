<?php 
$objcontents=new PageCms();
if(isset($_POST["emailid"],$_POST["name"]))
{
	$objcontents->contactUs($_POST);
	$gotolink=CreateLink(array("contents","itemid"=>"thanks"));
	redirectUrl($gotolink);
}
$pages = $objcontents->GetPageData(1);
$contentdata=$objcontents->GetArticales($data["itemid"]);
$itfMeta=array("title"=>$contentdata["pagetitle"],"description"=>$contentdata["pagemetatag"],"keyword"=>$contentdata["pagekeywords"]);
$page = new PageCms();

$pages1 = $page->GetPageData(2);

?>
<div class="inner_page page_title">
<div class="span12 pgtitle">
<h1><span>Vendors</span></h1>
</div>
</div>
 <div class="page-content">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12column-right">
                <div class="blog-post">
					<div class="post-sec1 col-md-4">
						<div class="post-image">
							<a href="<?php echo CreateLink(array('vendor','itemid'=>'detail&id='.$product['id'])); ?>"><img src="<?php echo TemplateUrl();?>images/blog-post-img-1.png" alt=""></a>
						</div>
					
                        </div>
                        	<div class="post-sec2 col-md-6">
						<h6 class="post-title">BLUEBERRY LAUNDRY AND DRY CLEANERS</h6>
						<div class="post-cat"><span>Dry Cleaning</span> | 
                        <span>Wash & Fold</span> | 
                        <span>Wash & Iron </span>  | 
                       <span>Iron Premium Laundry </span>  | 
                     <span>Organic Dry Cleaning</span>  
                     </div>
						<div class="post-teaser">
                           <p> <i class="fa fa-clock"></i> Delivery with in 1 day </p>
                           <p> ₹ Minimum Order price is 200 </p>
						</div>
						
					</div>
                        	<div class="post-sec3 col-md-2">
                            		<h6 class="post-rate"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span></h6>
                                    <div class="bt_vendor"><a href="">Order Now!</a></div>
                            </div>
				</div>
             <div class="blog-post">
					<div class="post-sec1 col-md-4">
						<div class="post-image">
							<a href="#"><img src="<?php echo TemplateUrl();?>images/blog-post-img-1.png" alt=""></a>
						</div>
					
                        </div>
                        	<div class="post-sec2 col-md-6">
						<h6 class="post-title">BLUEBERRY LAUNDRY AND DRY CLEANERS</h6>
						<div class="post-cat"><span>Dry Cleaning</span> | 
                        <span>Wash & Fold</span> | 
                        <span>Wash & Iron </span>  | 
                       <span>Iron Premium Laundry </span>  | 
                     <span>Organic Dry Cleaning</span>  
                     </div>
						<div class="post-teaser">
                           <p> <i class="fa fa-clock"></i> Delivery with in 1 day </p>
                           <p> ₹ Minimum Order price is 200 </p>
						</div>
						
					</div>
                        	<div class="post-sec3 col-md-2">
                            		<h6 class="post-rate"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span></h6>
                                    <div class="bt_vendor"><a href="">Order Now!</a></div>
                            </div>
				</div>
                <div class="blog-post">
					<div class="post-sec1 col-md-4">
						<div class="post-image">
							<a href="#"><img src="<?php echo TemplateUrl();?>images/blog-post-img-1.png" alt=""></a>
						</div>
					
                        </div>
                        	<div class="post-sec2 col-md-6">
						<h6 class="post-title">BLUEBERRY LAUNDRY AND DRY CLEANERS</h6>
						<div class="post-cat"><span>Dry Cleaning</span> | 
                        <span>Wash & Fold</span> | 
                        <span>Wash & Iron </span>  | 
                       <span>Iron Premium Laundry </span>  | 
                     <span>Organic Dry Cleaning</span>  
                     </div>
						<div class="post-teaser">
                           <p> <i class="fa fa-clock"></i> Delivery with in 1 day </p>
                           <p> ₹ Minimum Order price is 200 </p>
						</div>
						
					</div>
                        	<div class="post-sec3 col-md-2">
                            		<h6 class="post-rate"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span></h6>
                                    <div class="bt_vendor"><a href="">Order Now!</a></div>
                            </div>
				</div>
        
				</div>
			
			</div>
		</div>
	</div>
      
 <style>
.checked {
  color: orange;
}
</style>           