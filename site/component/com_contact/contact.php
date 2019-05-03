<?php 

$cmspage = new PageCms();

if(isset($_POST['submit']) && !empty($_POST['email'])){
	
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	         
			 $secret = '6LfIeooUAAAAAALOOhPC2_AcYj8SgoIad33KdEwT';
		//get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
	
		 if($responseData->success){
			 
			 
$cmspage->Add_Contact_Request($_POST);
flashMsg("You have successfully Place the Enquiry");
redirectUrl(CreateLink(array("contact")));
		 }
}else {
	
	flashMsg("Please fill the captcha box");
	}
	}
?>
<script type="text/javascript">
      var onloadCallback = function() {
grecaptcha.render('recaptcha1', {'sitekey' : '6LfIeooUAAAAADEjpEHgEAz_k6hYuNJ_MxTDgb90', 'theme' : 'light' });
}; 
    </script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<div class="inner_page page_title">
<div class="span12 pgtitle">
<h1><span>Contact Us</span></h1>
</div>
</div>

<div class="page-content">
<div class="container-fluid contact_content">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7011.915086148236!2d77.07964002543109!3d28.5109250798636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d195bff2b13b9%3A0x14f442252e2843c4!2sUdyog+Vihar+Phase+1%2C+Udyog+Vihar%2C+Sector+20%2C+Gurugram%2C+Haryana+122022!5e0!3m2!1sen!2sin!4v1545280213307" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="container">
		
			<div class="row">
				<div class="col-sm-5 col-md-4 col-lg-4">
					<div class="contact-box-01">
						<h6 class="title">Our address:</h6> <p>Plot No 29, Udyog Vihar Phase 1,
						<br> Gurgaon - 122001 , India</p>
					</div>
					<div class="contact-box-02">
						<h6 class="title">Call us:</h6><p> <a href="tel:+91 810 202 0271">+91 810 202 0271</a></p>
					</div>
					<div class="contact-box-03">
						<h6 class="title">Have any questions?</h6>
						<p><a href="mailto:info@creaseart.com">info@creaseart.com</a></p>
						
					</div>
					<ul class="social-icon-content">
						<li><a href="https://www.facebook.com/creaseartapp" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/ArtCrease" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/crease-art-97a2a7174/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.instagram.com/creaseartapp/" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
				<div class="col-sm-7 col-md-8 col-lg-7 col-lg-offset-1">
					<!-- form-block -->
			  <form name="frmcontact" enctype="multipart/form-data" method="post" id="frmcontact">
              <input class="form-control" type="hidden" value="Contact_Page" name="from_page" required="required">
						<div id="success">
							<p>Your message was sent successfully!</p>
						</div>
						<div id="error">
							<p>Something went wrong, try refreshing and submitting the form again.</p>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-6">
								<div class="form-group">
									<label class="control-label">Name</label>
									<input class="form-control" type="text" value="" name="name" required="required">
								</div>
							</div>
							<div class="col-md-12 col-lg-6">
								<div class="form-group">
									<label class="control-label">Phone</label>
									<input class="form-control" type="tel" value="" name="phone" required="required">
								</div>
							</div>
						</div>
                        <div class="row">
                        <div class="col-md-12 col-lg-6">
						<div class="form-group">
							<label class="control-label">E-mail</label>
							<input class="form-control" type="email" value="" name="email" required="required">
						</div></div>
                                 <div class="col-md-12 col-lg-6">
                        <div class="form-group">
							<label class="control-label">Subject</label>
							<input class="form-control" type="text" value="" name="subject" required="required">
						</div>	</div>	</div>
						<div class="form-group">
							<label class="control-label">Message</label>
							<textarea class="form-control" rows="10" name="message"></textarea>
						</div>
                        <div class="form-group">
                         <div class="g-recaptcha" id="recaptcha1"></div></div>
						<button class="btn btn-default btn-top" type="submit" id="submit" name="submit" value="submit">SEND MESSAGE</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
