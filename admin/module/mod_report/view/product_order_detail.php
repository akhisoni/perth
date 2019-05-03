<?php
$prod = new Product();
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $objReport->CheckProductTransactions($ids);
$infos=$prod->productId($ItfInfoData['tempid']);
$qty = array($infos['quantity']);
$orderInfoProduct = $prod->productOrderInfo($ItfInfoData['tempid']);
$str=$infos['quantity'];
$ttyl = explode(",",$str);
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
      <input id="user_name"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="user_name" value="<?php echo isset($ItfInfoData['user_name'])?$ItfInfoData['user_name']:'' ?>"/>
    </div>
    <div class="element">
      <label>Email Id</label>
      <input id="user_email"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="user_email" value="<?php echo isset($ItfInfoData['user_email'])?$ItfInfoData['user_email']:'' ?>"/>
    </div>
    <div class="element">
      <label>Date Added</label>
      <input id="date_added"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="date_added" value="<?php echo isset($ItfInfoData['date_added'])?$ItfInfoData['date_added']:'' ?>"/>
    </div>
    <div class="element">
      <label>Product Id</label>
      <input id="product_id"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="product_id" value="<?php echo isset($ItfInfoData['product_id'])?$ItfInfoData['product_id']:'' ?>"/>
    </div>
    <div class="element">
      <label>Quantity</label>
      <input id="quantity"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="quantity" value="<?php echo isset($ItfInfoData['quantity'])?$ItfInfoData['quantity']:'' ?>"/>
    </div>
    <div class="element">
      <label>Unit Price</label>
      <input id="price"  disabled type="text" class="form-control textarea" data-map-container-id="collapseTwo"  name="price" value="<?php echo isset($ItfInfoData['price'])?$ItfInfoData['price']:'' ?>"/>
    </div>
    <div class="element">
      <?php
	  $i=0;
	   foreach($orderInfoProduct as $Info){?>
      <div class="order_product_list"> <a href="<?php echo SITEURL; ?>/<?php echo CreateLink(array('product','itemid'=>'detail','id'=>$Info['id'])); ?>"> <img src="<?php echo PUBLICPATH."products/".$Info['main_image']; ?>" width="100" height="100">
        <h2> <?php echo $Info['name'];?> </h2>
        </a> <br />
        <strong>Unit Price :</strong> <?php echo $price = $Info['price'];?> <strong>Quantity :</strong> <?php echo $qty = $ttyl[$i++];?> <strong>Total Price :</strong> <?php echo $qty * $price; ?> </div>
      <?php }?>
    </div>
    <!-- Form Buttons -->
    <div class="entry">
      <button type="button" onclick="history.back()">Back</button>
    </div>
    <!-- End Form Buttons -->
  </form>
  <!-- End Form --> 
</div>
