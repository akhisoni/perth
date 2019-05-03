<?php

$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $objReport->CheckEventTransactions($ids);

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
               <input id="name"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="name" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>"/>
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
      <label>Event Id</label>
               <input id="event_id"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="event_id" value="<?php echo isset($ItfInfoData['event_id'])?$ItfInfoData['event_id']:'' ?>"/>
           </div>
     
             
               <div class="element">
      <label>Event Name</label>
               <input id="event_name"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="event_name" value="<?php echo isset($ItfInfoData['event_name'])?$ItfInfoData['event_name']:'' ?>"/>
           </div>
           
           
        
        
        
<!-- Form Buttons -->
    <div class="entry">
        <button type="button" onclick="history.back()">Back</button>
    </div>
<!-- End Form Buttons -->
</form>
    <!-- End Form -->
</div>
