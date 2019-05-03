<?php 

$cmspage = new PageCms();

if(isset($_POST['submit']) && !empty($_POST['email'])){
	         
$cmspage->Add_Email_Request($_POST);
flashMsg("You have successfully Place the Enquiry");
redirectUrl(CreateLink(array("offer-signup")));

}

?>

<div class="page-content signoffer">
 
    <div class="page-wrapper"> 
      <!-- ============================================================== --> 
      <!-- Container fluid  --> 
      <!-- This is top banner start -->
      <div class="signbanner"> <img src="<?php echo TemplateUrl();?>images/offer_bann.png" class="img-fluid1" alt="Responsive image"> </div>
      <!-- This is top banner End-->
      <div class="container-fluid"> 
        <!-- ============================================================== --> 
        <!-- Static Slider 1  --> 
        <!-- ============================================================== -->
        <div class="static-slider9 po-relative"> 
          <!-- Row  -->
          <div class="row">
            <div class="container"> 
              <!-- Column -->
              <div class="col-md-6 info-detail align-self-center">
                <h1 class="title">Sign Up & Get 50% OFF</h1>
                <h5 class="subtitle">To avail this offer, you will have to signup the below form</h5>
                <br>
                <div class="formwrap forminner">
                <div class="text-light">
                <form method="post" action="" name="form">
                <input class="form-control" type="hidden" value="Offer_Page" name="from_page">
                  <label for="inputPassword2" class="">Name</label>
                  <input type="text" class="form-control name" id="inputPassword2" name="name" placeholder="Your Name" required>
                  <label for="inputPassword2" class="">Phone Number</label>
                  <input type="tel" class="form-control name" id="inputPassword2" name="phone" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                  <label for="inputPassword2" class="">Email Address</label>
                  <input type="email" class="form-control name" id="inputPassword2" name="email" placeholder="Email Address" required>
                  <input type="submit" name="submit" value="submit" class="btn-default">
                   </form>
                  </div>
                  </div>
               
                <!-- Column --> 
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-4 bg-img" style="background-image:url(<?php echo TemplateUrl();?>images/)"> <img src="<?php echo TemplateUrl();?>images/mob_bg.png" alt="wrapper" class="img-fluid2" data-aos="fade-up" data-aos-duration="2200" /> </div>
            <!-- Column --> 
          </div>
        </div>
        <!-- ============================================================== --> 
        <!-- End Static Slider 1  --> 
        <!-- ============================================================== --> 
      </div>
      <!-- ============================================================== --> 
      <!-- End Container fluid  --> 
      <!-- ============================================================== --> 
      <!-- ============================================================== --> 
      <!-- Back to top --> 
      <!-- ============================================================== --> 
      <!--<div id="newsletter" class=" text-center bg-dark text-light">
            <h2 class="text-center text-light newshead">Subscribe our newsletter</h2>
            <p >Subscribe to our newsletter and stay updated on the latest and special offers!</p>
            <input class="newsletterform" name="name" placeholder="Your Name" type="name" required="required"> <br>
						<input class="newsletterform" name="email" placeholder="Email Address" type="email" required="required">
            <div>
            <button class="btn btn-default btn-top newssbtn">Submit</button>
            </div>
            </div>--> 
    </div>

</div>

<style type="text/css">
.h1-nav {
	padding: 15px 0;
}
.h1-nav .navbar-nav .nav-item > .nav-link {
	line-height: 70px;
}
.h1-nav .navbar-nav .nav-item {
	margin: 0 20px;
}
.h1-nav .navbar-nav .nav-item .nav-link {
	padding: 12px 0px;
	color: #8d97ad;
	font-weight: 400;
}
.h1-nav .navbar-nav .nav-item:hover .nav-link {
	color: #07d79c;
}
.h1-nav .navbar-nav .nav-item:last-child {
	margin-right: 0px;
}
/*******************
Static slide 9
*******************/
.static-slider9 {
	overflow: hidden;
}
.static-slider9 .bg-img {
	background-size: cover;
	background-position: center center;
	position: absolute;
	right: 0px;
	height: 100%;
}
.static-slider9 .bg-img img {
    margin-left: -80px;
    padding-top: 25px;
    bottom: 0px;
}
.static-slider9 .container {
	z-index: 1;
}
.static-slider9 .info-detail {
	min-height: calc(100vh - 0px);
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-orient: vertical;
	-webkit-box-direction: normal;
	-webkit-flex-direction: column;
	-ms-flex-direction: column;
	flex-direction: column;
	-webkit-box-pack: center;
	-webkit-justify-content: center;
	-ms-flex-pack: center;
	justify-content: center;
	overflow: auto;
}
.static-slider9 .info-detail .title {
	font-size: 44px;
	font-weight: 700;
	line-height: 50px;
}
.static-slider9 .info-detail .subtitle {
	margin-top:-30px;
}
.static-slider9 .adv-img {
	padding-top: 20px;
}
 @media (max-width: 767px) {
.static-slider9 .bg-img {
	position: relative;
}
.static-slider9 .bg-img img {
	margin-left: 0px;
	padding: 20px 20px 0 20px;
	position: relative;
}
.static-slider9 .info-detail .title {
	font-size: 40px;
}
.newsletterform {
	width: 70% !important;
}
}
/*******************
footer social icons
*******************/
footer .round-social a {
	background: rgba(120, 130, 140, 0.13);
	color: #8d97ad;
	width: 40px;
	height: 40px;
	line-height: 40px;
}
footer .round-social a:hover {
	color: #ffffff;
}
/*******************
Newslatter Section
*******************/


.getbtn {
	width: 30%;
	margin-top: 20px;
}
.newssbtn {
	margin-top: 15px;
	margin-bottom: 15px;
}
.newsletter {
	background-color: #B52421;
	margin-top: 30px;
}
.newshead {
	padding-top: 30px;
	padding-bottom: 0px;
}
.newsbtn {
	margin-top: 20px;
	margin-bottom: 20px;
}
.newsletterform {
	width: 35%;
	font-size: 14px;
	color: #242424;
	font-weight: 600;
	line-height: normal;
	height: 39px;
	border: 1px solid #ccc;
	padding: 0 17px;
	border-radius: 6px;
	appearance: none;
	box-shadow: none;
	-ms-appearance: none;
	-moz-appearance: none;
	-webkit-appearance: none;
	outline: 0!important;
	letter-spacing: .7px;
	margin-top: 20px;
}
/*******************
Offer Form Section
*******************/

.formwrap {
	background-color: #000;
}
.forminner {
	padding-top: 20px;
	padding-left: 20px;
	padding-right: 20px;
	padding-bottom: 20px;
	border-radius:10px;
}
.signbanner {
	text-align:center;
}
.orders_now {
	display:none;
}
.page-content .container, .page-content .content {
	margin-top:10px !important;
}
.name, .email {
    width: 100% !important;
    font-size: 14px;
    color: #242424;
    font-weight: 600;
    line-height: normal;
    height: 39px;
    border: 1px solid #ccc;
    padding: 0 17px;
    border-radius: 6px;
    appearance: none;
    box-shadow: none;
    -ms-appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    outline: 0!important;
    letter-spacing: .7px;
    margin-top: 5px !important;
}
.container-fluid {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    background-image: url(https://www.creaseart.com//template/default/images/washing_powder.jpg);
	background-repeat: repeat-x;
}
.img-fluid1 {
    max-width: 100%;
    height: auto;
}
.img-fluid2 {
    max-width: 70%;
    height: auto;
}
.page-content { margin-bottom:0px !important;}
</style>