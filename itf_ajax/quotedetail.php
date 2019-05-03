<?php 
$msgs="Login";
require('../itfconfig.php');
$obj = new Quote();
$service = new ServiceCategory();
$objProduct = new Product();$objCategory = new Category();
if(isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
    $quote_info = $obj->checkQuote($_REQUEST['id']);
    //echo"<pre>";print_r($quote_info);die;
    $services = $service->CheckCategory($quote_info['service_cat']);   
    $results = $obj->getQuoteDetails($_REQUEST['id']);
}
$bids = $obj->getBidsByQuote($quote_info['id']);
?>
<div class="enq_mat">

        <h3>Enquiry Detail</h3>
        <p style="font-weight: bold; color: #000; margin-top: 10px;"><?php echo $quote_info['quote_name']; ?></p>
        <?php if(count($results) >0 ){ 
            //echo "<pre>";print_r($results);die;?>
        <?php foreach($results as $result){
            
       
            ?>
        
       <?php if($result['name']!=NULL){?>
       
        
        <div class="enq_mat_cont">

           <div class="pro_category">
                <p class="name">                   
                   
                    <label>Product Name:</label> <span > <a href="<?Php echo CreateLink(array("product",'itemid'=>'detail','id'=>$result['id']));?>"><?php echo $result['name']; ?>    </a></span>
                
                </p>
                <?php if($result['service']!='') { 
                    $sql = "SELECT * FROM `itf_service_category`WHERE id IN ( ".$result['service']." )";
                    $datas = $this->dbcon->FetchAllResults($sql);
                    foreach($datas as $data){ 
                    ?>                
                <p><label>Product Category : </label> <span><?php echo $result['service']; ?></span></p>
                
                <?php }} ?>

                <?php if($services['catname']) { ?>
                <p><label>Service Category: </label> <span><?php echo $services['catname']; ?></span></p>
                <?php } 
                
                $productInfo = $objProduct->CheckProduct($result['product_id']);                
                $breadcrumb = $objCategory->getQuoteProductParentHierarchy($productInfo['category_id']);
                ?>
                 <p><label>Parent Hierarchy: </label><span><?php echo $breadcrumb; ?></span></p>
                <p><label>Quantity: </label><span><?php echo $result['quantity'] > 0 ?$result['quantity']:'NA'; ?></span></p>
                <?php if($result['logn_desc']) { ?>
                <p><label>Quote Details:</label><span><?php echo $result['logn_desc']; ?></span></p>
                <?php } ?>
                <?php if($result['special_req']) { ?>
                    <p><label>Advise Delivery Area:</label><span><?php echo $result['special_req']; ?></span></p>
                <?php } ?>
                <?php if($quote_info['attachment']) { ?>
                    <p><label>Attachment:</label><span><a href="<?php echo PUBLICPATH."products/".$quote_info['attachment']; ?>" target="_blank" ><?php echo $quote_info['attachment']; ?></a></span></p>
                <?php } ?>
            </div>
        <?php } else {?>
             <div class="enq_mat_cont">

           <div class="pro_category">
               <p><label>Product Category : </label>
               <?php if($result['service']!='') { 
                   $sql = "SELECT * FROM `itf_service_category`WHERE id IN ( ".$result['service']." )";
                    $res = mysql_query($sql);                  
                    while($datas = mysql_fetch_assoc($res)){ 
                    ?>                
                <span><?php echo $datas['catname'];  ?> </span>
               <?php $sqlp = "SELECT * FROM `itf_service_category`WHERE id = ".$datas['parent']; 
                     $resp = mysql_query($sqlp); 
                     $datasp = mysql_fetch_assoc($resp);
                     echo "<span>";
                   if($datasp){echo "Parent :".$datasp['catname']."<br>";}
                      echo "....................................";
                      echo "</span>";
               ?>
                      
                <?php  }} ?></p>

                <?php if($services['catname']) { ?>
                <p><label>Service Category: </label> <span><?php echo $services['catname']; ?></span></p>
                <?php } ?>
               
                <?php if($result['logn_desc']) { ?>
                <p><label>Quote Details:</label><span><?php echo $result['logn_desc']; ?></span></p>
                <?php } ?>
                <?php if($result['special_req']) { ?>
                    <p><label>Advise Delivery Area:</label><span><?php echo $result['special_req']; ?></span></p>
                <?php } ?>
                <?php if($quote_info['attachment']) { ?>
                    <p><label>Attachment:</label></p><span><a href="<?php echo PUBLICPATH."products/".$quote_info['attachment']; ?>" target="_blank" ><?php echo $quote_info['attachment']; ?></a></span>
                <?php } ?>
            </div>
        <?php }?>
            <div class="pro_category_pic">
                <p><span>
                        <?php if(!empty($result['main_image']) and file_exists(PUBLICFILE."products/".$result['main_image'])) { ?>
                            <img src="<?php echo PUBLICPATH."products/".$result['main_image']; ?>" width="120px" height="122px" alt=""></a>
                        <?php } else { ?>
                            <img src="<?php echo PUBLICPATH."products/noImageProduct.jpg"; ?>" width="120px" height="122px" alt=""></a>
                        <?php } ?>
                    </span></p>
            </div>
            <div class="clear"></div>
        </div>
        <?php } } ?>
        <?php if($quote_info['quote_desc']) { ?>
        <div class="pro_category_cont">
            <p><label>Quote Description: </label><br><b><?php echo $quote_info['quote_desc']; ?></b></p>
        </div>
        <?php } ?>

        <?php if($_SESSION['FRONTUSER']['usertype'] == 2) { ?>

           <?php if(count($bids) > 0) { ?>
        <form id="request" name="bid_form" method="post" action="">
         <input name="quote_id" type="hidden" value="<?php echo $quote_info['id']; ?>">
         <div class="supply_quote">
            <ul>
                <li>
                    <div class="supply_lft">
                        <p>Supplier ID</p>
                    </div>
                    <div class="supply_mid">
                        <p>Bid Amount</p>
                    </div>
                    
                     <div class="supply_mid1">
                        <p>Attachments</p>
                    </div>
                    <div class="supply_rgt">
                        <p>Bid Details</p>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php foreach($bids as $bid) {
                    
               
                    ?>
                <li>
                    <div class="supply_lft">
                         <p><span><a href='#' onclick='suppreviews("<?php echo $bid['supplier_id']; ?>");'><?php echo $bid['supplier_id']; ?></a></span></p>
                    </div>
                    <div class="supply_mid">
                        <p><?php echo Currency($bid['bid_amount']); ?></p>
                    </div>
                    <div class="supply_mid1">
                         
                        <p><a href="<?php echo PUBLICPATH."pdf/".$bid['attachment']; ?>" target="_blank" ><?php echo $bid['attachment']; ?></a></p>
                    </div>
                    
                    <div class="supply_rgt">
                        <p><?php echo $bid['bid_desc']; ?></p>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php } ?>

            </ul>
        </div>
            
        </form>
        <?php } else { ?>
        <div class="supply_quote"><P STYLE="font-size: 12px; margin-left: 10px;">No Bid for this quote yet. </P></div>
        <?php } ?>
        <?php }
        elseif($_SESSION['FRONTUSER']['usertype'] == 3 ){
		if($obj->isBidded($quote_info['id']) === false) 
            { ?>
            <div class="supplier_quote" id="request">
                <form name="supplier_quote" id="supplier_quote" enctype="multipart/form-data" method="post" action="" >
                    <input type="hidden" value="<?php echo $quote_info['id']; ?>" name="quote_id" id='quote_id'>
                     <input type="hidden" value="<?php echo $quote_info['quote_name']; ?>" name="quote_name">                        
                    <div style="float: left; margin-top: 20px;">
                    <label>Bid Price ($) <span class="required">*</span> </label>
                    <input type="text" id="bid_amount" name="bid_amount" placeholder="Enter Integer value"> <span class="example">(Use number only)</span>
                    </div>
                       <div style="float: left; margin-top: 20px;">
                    <label>Upload file</label>
                    <input type="file" name="attachment" id="attachment" value="upload">
                </div> 
                    <div style="float: left; margin-top: 20px;">
                    <label>Bid Details <span class="required">*</span></label>
                    <textarea name="bid_desc" id="bid_desc"></textarea>
                    </div>
					<!--<input type="button" onclick="addbids()" value='Submit'>-->
                    <input id="submit" type="submit" name="submit" value="Submit">
                </form>
            </div>
        <?php  }else {?>
		 <div class="supply_quote">
		      <ul>
                <li>
                    <div class="supply_lft">
                        <p>Supplier ID</p>
                    </div>
                    <div class="supply_mid" style='width:150px;'>
                        <p>Bid Amount</p>
                    </div>
                    <div class="supply_rgt" style='width:165px;'>
                        <p>Bid Details</p>
                    </div>
                    <div class="clear"></div>
                </li>
		     <?php foreach($bids as $bid) { 
			        if($quote_info['id']==$bid['quote_id']){
			         
			 ?>
              <li>                
				<div class="supply_lft">
                        <p><span><?php echo $bid['supplier_id']; ?></span></p>
                    </div>
                    <div class="supply_mid">
                        <p><?php echo Currency($bid['bid_amount']); ?></p>
                    </div>
					<div class="supply_rgt">
					   <p><?php echo $bid['bid_desc']; ?></p>
					</div>
				</li>
		<?php } } ?>
		   </ul>
		 </div>
		<?php } } ?>

    </div>
</div>