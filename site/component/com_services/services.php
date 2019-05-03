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
$pages2 = $page->GetPageData(7);
?>
<div class="inner_page page_title">
<div class="span12 pgtitle">
<h1><span>Services</span></h1>
</div>
</div>
 <div class="page-content">
            <div class="container">
    <!--            <h1 class="title-underline">A few words about us</h1>-->
                <p class="text-center info-text">
                 We strive to ensure quality laundry, on time delivery and reliable service for all linen, uniform and guest laundry needs. A dedicated in-plant quality assurance team is on hand to provide regular visual inspection to maintain quality standard and to seek for continuous improvements. The team would review and offer precise washing formula suitable for each type of linen.
                </p>
            </div>
           
            <div class="container services_boxs">
			<div class="row">
				<div class="col-md-4">
					<!-- services-box-info -->
					<a href="#" class="services-box-info animation" data-animation="fadeInLeft" data-animation-delay="0s">
						<div class="img">
							<img src="<?php echo TemplateUrl();?>images/washandfold.png" alt="">
						</div>
						<h4 class="title">
							Wash & Fold
						</h4>
						<div class="description">
							<p>
								Let us pick up your dirty laundry, sort it, pre-treat stains, wash, dry, fold and deliver back to you in one neat.
							</p>
						</div>
					</a>
					<!-- /services-box-info -->
				</div>
				<div class="divider divider-80 visible-sm visible-xs"></div>
				<div class="col-md-4">
					<!-- services-box-info -->
					<a href="#" class="services-box-info animation" data-animation="fadeIn" data-animation-delay="0s">
						<div class="img">
							<img src="<?php echo TemplateUrl();?>images/washandiron.png" alt="">
						</div>
						<h4 class="title">
							Wash & Iron
						</h4>
						<div class="description">
							<p>
								SMU students and local residents love on our reliable dry cleaning services for the fast, accurate, top quality results.
							</p>
						</div>
					</a>
					<!-- /services-box-info -->
				</div>
				<div class="divider divider-80 visible-sm visible-xs"></div>
				<div class="col-md-4">
					<!-- services-box-info -->
					<a href="#" class="services-box-info animation" data-animation="fadeInRight" data-animation-delay="0s">
						<div class="img">
							<img src="<?php echo TemplateUrl();?>images/iron.png" alt="">
						</div>
						<h4 class="title">
							Iron
						</h4>
						<div class="description">
							<p>
								To keep carpet at peak performance, we recommend professional deep cleaning your carpet every 12 to 18 months.
							</p>
						</div>
					</a>
					<!-- /services-box-info -->
				</div>
			</div>
		</div>
    
    
                 </div>
                 <div class="content carusel--parallax box-color-white" data-image="<?php echo TemplateUrl();?>images/parallax-img-02.jpg">
                  <div>&nbsp;</div>
			<div class="container text-center">
				<h2 class="title-underline">Commercial Laundry</h2>
				<p class="font-size-18">From an owner-operated hair salon to a government hospital and everything in between, we are the most responsive and cost-competitive laundry and linen provider in your city.</p>
				<div class="divider divider-47"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="box-icon-text animation" data-animation="fadeInLeft" data-animation-delay="0s">
							<span class="icon icon-towel2"></span>
							<div class="description">
								<h4 class="title"><a href="#">Sheets & Towels</a></h4>
								<p>
									Our linen program covers a range of products appropriate for use in businesses of all types and sizes. From the bedding for a 100 bed hospital to the hand towels at a local coffee shop.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box-icon-text animation" data-animation="fadeIn" data-animation-delay="0s">
							<span class="icon icon-garbage"></span>
							<div class="description">
								<h4 class="title"><a href="#">Janitorial Supplies</a></h4>
								<p>
									We offer a flat weekly rental price for items which includes our sustainable laundering and delivery service. We are also available to launder items you may already own.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box-icon-text animation" data-animation="fadeInRight" data-animation-delay="0s">
							<span class="icon icon-furniture"></span>
							<div class="description">
								<h4 class="title"><a href="#">Entryway and Floor Mats</a></h4>
								<p>
									We offer standard or customizable floor and entryway mats for a professional, clean appearance at your business that also increase safety and comfort for staff and customers.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="divider divider-47"></div>
			</div>
		</div>
                	<div class="row">
                 <div class="container-fluid">
		
				<a href="#" class="promo-fluid">
				  24/7 premium customer services
			  </a>
			
		</div>
        </div>
        <div>&nbsp;</div>
                 <div class="container">
			<h2 class="title-underline">Our Features</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="box-text animation" data-animation="fadeIn" data-animation-delay="0s">
						<h4 class="title"><a href="#">Install</a></h4>
						<p>Creaseart mobile app is available in both Google Play and Apple Store. It can be downloaded directly through our website or the web store. The application is relatively smaller in size, and it can be installed in less than two minutes. Consumers can log in through their Google account or create an account to stay connected with the latest trends and deals.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="box-text animation" data-animation="fadeIn" data-animation-delay="0s">
						<h4 class="title"><a href="#">Search</a></h4>
						<p>This fundamental aspect of the application is developed with an efficient algorithm to identify the ideal partner. The search can be conducted on the basis of the location, service required, package, rating and other particular criteria. The system displays the list of options based on the selection. These results can be further sorted based on the preferred criteria. </p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="box-text animation" data-animation="fadeIn" data-animation-delay="0s">
						<h4 class="title"><a href="#">Select</a></h4>
						<p>The customer can then know more about the company by browsing through the description. The rating system helps the consumers to validate the credibility of the company. They can also read the reviews given the other customers before making the final decision. </p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="box-text animation" data-animation="fadeIn" data-animation-delay="0s">
						<h4 class="title"><a href="#">Connect</a></h4>
						<p>They can connect with the laundry service provider through the contact us icon. The client can fill in their requirements and share it with the preferred vendors to complete the process. </p>
					</div>
				</div>
                <div class="col-xs-12 col-sm-6">
					<div class="box-text animation" data-animation="fadeIn" data-animation-delay="0s">
						<h4 class="title"><a href="#">Review</a></h4>
						<p>We encourage our consumer to share their experience with us. This will assist our application to rate the company and also serve as a scrutiny system. The companies offering quality services are segregated and offered special priority in the search results.</p>
					</div>
				</div>
			</div>
		</div>
                <div class="howitworks">
         <?php echo $pages2['logn_desc'];?>
          
        </div>
       
      
            