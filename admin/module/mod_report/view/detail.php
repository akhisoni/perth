<?php

$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $objReport->CheckTransactions($ids);

?>

 <div class="full_w">
	<!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
    <!-- Page Heading -->
					
<form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />

    <div class="element">
        <label>Order Id</label>
        <input class="text" disabled  name="id" type="text"  size="35" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />
    </div>


 

    <div class="element">
        <label>Transaction Id</label>
        <input class="text"  disabled name="txn_id" type="text" size="35" value="<?php echo isset($ItfInfoData['txn_id'])?$ItfInfoData['txn_id']:'' ?>" />
    </div>
    
     <div class="element">
        <label>Transaction Type</label>
        <input class="text"  disabled name="txn_type" type="text" size="35" value="<?php echo isset($ItfInfoData['txn_type'])?$ItfInfoData['txn_type']:'' ?>" />
    </div>
    
    
    <div class="element">
        <label>Amount</label>
        <input class="text"  disabled name="payment_amount" type="text"  size="35" value="<?php echo isset($ItfInfoData['payment_amount'])?$ItfInfoData['payment_amount']:'' ?>" />
    </div>
    
       <div class="element">
        <label>Currency</label>
        <input class="text"  disabled name="mc_currency" type="text"  size="35" value="<?php echo isset($ItfInfoData['mc_currency'])?$ItfInfoData['mc_currency']:'' ?>" />
    </div>
    
    
     
            <div class="element">
      <label>Payment Status</label>
               <input id="payment_status"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="payment_status" value="<?php echo isset($ItfInfoData['payment_status'])?$ItfInfoData['payment_status']:'' ?>"/>
           </div>
     
     
            <div class="element">
      <label>Name</label>
               <input id="first_name"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="first_name" value="<?php echo isset($ItfInfoData['first_name'])?$ItfInfoData['first_name']:'' ?>"/>
           </div>
     
     
            <div class="element">
      <label>Email Id</label>
               <input id="payer_email"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="payer_email" value="<?php echo isset($ItfInfoData['payer_email'])?$ItfInfoData['payer_email']:'' ?>"/>
           </div>
     
             
       <div class="element">
      <label>Date Added</label>
               <input id="date_added"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="date_added" value="<?php echo isset($ItfInfoData['date_added'])?$ItfInfoData['date_added']:'' ?>"/>
           </div>
     
               <div class="element">
      <label>Expiry Date</label>
               <input id="exp_date"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="exp_date" value="<?php echo isset($ItfInfoData['exp_date'])?$ItfInfoData['exp_date']:'' ?>"/>
           </div>
           
           
               <div class="element">
      <label>Package Id</label>
               <input id="package_id"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="package_id" value="<?php echo isset($ItfInfoData['package_id'])?$ItfInfoData['package_id']:'' ?>"/>
           </div>
     
             
               <div class="element">
      <label>Package Name</label>
       <input id="package_name"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="package_name" value="<?php echo isset($ItfInfoData['package_name'])?$ItfInfoData['package_name']:'' ?>"/>
           </div>
           
           
           
               <div class="element">
      <label>Package Duration</label>
               <input id="plan_duration"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="plan_duration" value="<?php echo isset($ItfInfoData['plan_duration'])?$ItfInfoData['plan_duration']:'' ?>"/>
           </div>
     
             
      
        
        
        
<!-- Form Buttons -->
    <div class="entry">
        <button type="button" onclick="history.back()">Back</button>
    </div>
<!-- End Form Buttons -->
</form>
    <!-- End Form -->
</div>
