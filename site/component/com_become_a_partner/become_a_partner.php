<?php 

$cmspage = new PageCms();

if(isset($_POST['submit']) && !empty($_POST['email'])){
	         
$cmspage->Add_Vendor_Request($_POST);
flashMsg("You have successfully Place the Enquiry");
redirectUrl(CreateLink(array("become_a_partner")));

}

?>
<div class="inner_page page_title">
<div class="span12 pgtitle">
<h1><span>Become Partner With US</span></h1>
</div>
</div>
 
        <div class="page-content vendor">
        <div class="container">
                <h1 class="text-center info-text_vendor">
                    Get listed on India's leading online
marketplace for Laundry services
                </h1>
            </div>
        <!--  This is vendor banner section -->
       
        <div class="vendorback">
            <div class="container">
                <div class="row">
                </div>
                <div class="container emptyblock col-md-6">
                </div>
                <div class="formblock col-md-6 container">
                    <form name="frmcontact" enctype="multipart/form-data" method="post" id="frmcontact" class="contact100-form validate-form">
      <label class="label-input100" for="first-name">Tell us your name <span class="validate_eror">*</span></label>
      <div class="wrap-input100  validate-input" data-validate="Type first name">
        <input id="first-name" class="input100" type="text" name="fname" required="required">
        <span class="focus-input100"></span> </div>
        
      <label class="label-input100" for="Address">Enter Your Company Name</label>
      <div class="wrap-input100">
        <input id="phone" class="input100" type="text" name="cname">
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="email">Enter your email <span class="validate_eror">*</span></label>
      <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input id="email" class="input100" type="email" name="email" required="required" >
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="phone">Enter phone number <span class="validate_eror">*</span></label>
      <div class="wrap-input100">
        <input id="phone" class="input100" type="text" name="phone" required="required" >
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="message">Message </label>
      <div class="wrap-input100 validate-input" data-validate="Message is required">
        <textarea id="message" class="input100" name="message"></textarea>
        <span class="focus-input100"></span> </div>
        
        
      <div class="container-contact100-form-btn">
        <button class="contact100-form-btn" type="submit" id="submit" name="submit"> Send Message </button>
      </div>
    </form>
                </div>
            </div>
        </div>
  
  </div>

<!--<div class="vendorhead text-center">
  <div class="vendorbanner">
    <h2 class="vthone">Become a Partner With US</h2>
    <p class="vptext text-dark"> Get listed on India's leading online
      marketplace for Laundry service, </p>
  </div>
</div>
<div class="container-contact100">
  <div class="wrap-contact100">
  
  <div class="vendor_form">
  <form name="frmcontact" enctype="multipart/form-data" method="post" id="frmcontact" class="contact100-form validate-form">
      <label class="label-input100" for="first-name">Tell us your name <span class="validate_eror">*</span></label>
      <div class="wrap-input100  validate-input" data-validate="Type first name">
        <input id="first-name" class="input100" type="text" name="fname" required="required">
        <span class="focus-input100"></span> </div>
        
      <label class="label-input100" for="Address">Enter Your Company Name</label>
      <div class="wrap-input100">
        <input id="phone" class="input100" type="text" name="cname">
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="email">Enter your email <span class="validate_eror">*</span></label>
      <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input id="email" class="input100" type="email" name="email" required="required" >
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="phone">Enter phone number <span class="validate_eror">*</span></label>
      <div class="wrap-input100">
        <input id="phone" class="input100" type="text" name="phone" required="required" >
        <span class="focus-input100"></span> </div>
        
        
      <label class="label-input100" for="message">Message </label>
      <div class="wrap-input100 validate-input" data-validate="Message is required">
        <textarea id="message" class="input100" name="message"></textarea>
        <span class="focus-input100"></span> </div>
        
        
      <div class="container-contact100-form-btn">
        <button class="contact100-form-btn" type="submit" id="submit" name="submit"> Send Message </button>
      </div>
    </form>
  </div>

    
    
  </div>
</div>
-->