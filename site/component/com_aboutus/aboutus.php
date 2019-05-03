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
<h1><span>About Us</span></h1>
</div>
</div>
 <div class="page-content">
            <div class="container">
           <!--     <h1 class="title-underline">A few words about us</h1>-->
                <p class="text-center info-text">
                   Creaseart Application is an innovative and beneficial app designed by our company in an effort to modernise the laundry & dry-cleaning industry. This app has successfully infused technological advancements into the service aspect of the laundry solutions. Our latest addition is designed to position this industry among the growing popularity of the digital segment.  Our company aims to improve consumer experience by widening the service options in a swipe.  It is a user-friendly and practical application which creates a platform for laundry service providers to promote their services. <br/ > It also offers the consumers to identify the right vendor for their cleaning needs. Our entire process is streamlined using international process control to assure standardised laundry solutions to our clientele. Our application is designed with the state of the art technology which aids us to offer quality laundry solutions to our customers. We understand the significance of these services in the lives of our consumers and have formulated hassle-free interface to provide the perfect solutions for our clients. The application is aesthetically pleasing, compatible with all devices and has an extremely secure payment system. 
                </p>
            </div>
            <div class="container">
                        <?php echo $pages1['logn_desc'];?>

              
            </div>
            
                <div class="container">
                    <!--<h1 class="title-underline">A few words about us</h1> -->
                </div>
            </div>
      
            