<?php
$objReport = new Product();
$ids=isset($_GET['id'])?$_GET['id']:'';
$perpage = $stieinfo['paging_size'] ;//limit in each page

if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);

	if($acts=='delete')
        $objReport->deleteOrder($ids);
		flash("Order is succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}

if(isset($_REQUEST['searchuser']) and !empty($_REQUEST['searchuser']))
{
    //echo"<pre>";print_r($_REQUEST);
	$InfoData1 = $objReport->ShowAllOrderSearchByVendorid($_REQUEST['txtsearch'],$_REQUEST['seller_id']);
}
else
{
  $InfoData1 = $objReport->getOrderlistByVendorId($ids);
}


$totalprice = $objReport->getTotalPricelistByVendorId($ids);
$totprice = $totalprice[0]['SUM(total_amount)']; 
$totalcount = $objReport->getTotalOrderlistByVendorId($ids);
$totitem = $totalcount[0]['count(*)']; 

$urlpath = CreateLinkAdmin(array($currentpagenames,'actions'=>'list'))."&";
$pagingobj = new ITFPagination($urlpath,$perpage);
$InfoData = $pagingobj->setPaginateData($InfoData1);

$quote = new Quote();

$users = new User();
$catname = new Category();
$disc = new Discount();

$itfUserdata = $users->ShowAllSupplierAdmin();

//echo "<pre>"; print_r($InfoData); die;
?>

<!-- Box -->

<div class="full_w"> 
  <!-- Page Heading -->
  <div class="h_title"><?php echo $pagetitle;?> Order</div>
  <!-- Page Heading -->

  <div class="entry top_buttons">
   
     <form id="itffrmsearch" name="itffrmsearch" method="post" action="<?php echo CreateLinkAdmin(array($currentpagenames,'search'=>'text')); ?>">

				<label>Search <?php echo $pagetitle; ?></label>
        
				<input type="hidden" name="itfpage" value="<?php echo $currentpagenames; ?>" />

				<input name="txtsearch" type="text" id="txtsearch" class="field small-field" value="<?php echo isset($_SESSION['SEARCHDATA']['txtsearch'])?$_SESSION['SEARCHDATA']['txtsearch']:""; ?>" />
				<input name="searchuser" type="submit" id="searchuser"class="button" value="Search" />

				</form>
                <p style="font-size:16px; line-height:20px;">
                Total Order Items:   <b style="color:#B52421;"><?php echo $totitem; ?></b><br />
                Total Order Price: <b style="color:#B52421;">₹<?php echo $totprice; ?></b>  
                
                </p>
  
    </div>
  <div class="clear"></div>
  <form id="itffrmlists" name="itffrmlists" method="post" action="">
    <input type="hidden" name="itfactions" id="itfactions" value="" />
    <input type="hidden" name="itf_status" id="itf_status" value="" />
    <table>
      <thead>
      <th scope="col" style="width:10px;">&nbsp;
          <input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
        <th scope="col">Order Id</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer Address</th>
        <th scope="col">Pick up date & Time</th>
        <th scope="col">Deliver date & Time</th>
        <th scope="col">Total Amount</th>
           <th scope="col">Order Status</th>
        <th scope="col">Order Date</th>
        <th scope="col">View Details</th>
      </tr>
        </thead>
      
      <tbody>
        <?php
            if(count($InfoData) > 0){
                for($i=0;$i<count($InfoData);$i++)
                {
					$customer_name = $users->CheckProfileIDUser($InfoData[$i]['usid']);
                    ?>
        <tr>
          <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $InfoData[$i]['id']; ?>" class="itflistdatas"/></td>
          <td class="align-center"><?php echo $InfoData[$i]['id']; ?></td>
          <td class="align-center"><?php echo $customer_name['name']; ?> <?php echo $customer_name['last_name']; ?></td>
          <td class="align-center"><?php echo $InfoData[$i]['user_address']; ?></td>
          <td class="align-center"><?php echo $InfoData[$i]['pickup_date']; ?> | <?php echo $InfoData[$i]['pickup_time']; ?></td>
          <td class="align-center"><?php echo $InfoData[$i]['deliver_date']; ?> | <?php echo $InfoData[$i]['deliver_time']; ?></td>
          <td class="align-center">₹ <?php echo $InfoData[$i]['total_amount']; ?></td>
          <td class="align-center"><?php if($InfoData[$i]['active_status']==1) echo "Active";else echo "Cancel"; ?></td>
          <td class="align-center"><?php echo  $InfoData[$i]['date_added']; ?></td>
          <td class="align-center"><a href="#itf" onclick="showBox(<?php echo $InfoData[$i]['id']; ?>);" title="Edit" alt="Edit"><img src="img/view.png" border="0" /></a></td>
        </tr>
        <tr id="content_detail_<?php echo $InfoData[$i]['id']; ?>" style="display: none;" class="trclss">
          <?php $details1 = $objReport->getOrderDetailsAdminById($InfoData[$i]['id']); 
		  $discs = $disc->ShowAllVendorStatusByOrderid($InfoData[$i]['id']);
		  $paym = $disc->ShowPaymentmodebyid($details1[0]['payment_mode']);
		// print_r($discs);
	//print_r($details1);
	if($details1[0]['rider_id']){
		$rider = $users->CheckProfileUsers($details1[0]['rider_id']); 
	}else {
		$rider = $users->CheckProfileUsers($details1[0]['rider_id']); 
	    $rider['name'] ='rider not assign';
		$rider['email_phone']='rider not assign';
		
		}
		 $ordeitem = $objReport->getOrderItemByOrderId($details1[0]['order_id']);
?>
          <td colspan="10">
              <h4 style="font-size:14px; margin:10px;">Vendor & Rider Detail</h4>
            <table class="details">
              <tbody>
            
                <tr>
      
                  <td class="colsnheading">Vendor Name</td>
                  <td><?php echo $details1[0]['company_name']; ?></td>
                   <td class="colsnheading">Vendor Address</td>
                  <td><?php echo $details1[0]['address']; ?></td>
                </tr>
                <tr>
                  <td class="colsnheading">Vendor Phone No.</td>
                  <td><?php echo $details1[0]['email_phone']; ?></td>
                  <td class="colsnheading">Rider Name</td>
                  <td><?php echo $rider['name']; ?></td>
                </tr>
                
                <tr>
                  <td class="colsnheading">Rider Phone no.</td>
                  <td><?php echo $rider['email_phone']; ?></td>
                  <td class="colsnheading"></td>
                  <td></td>
                </tr>
              
              </tbody>
             
            </table>
             <h4 style="font-size:14px; margin:10px;">Order Item Detail</h4>
            
            <table class="details">
            <tr>
            <td><strong>Product Category</strong></td>
            <td><strong>Product Name</strong></td>
               <td><strong>Product Qunatity</strong></td>
                  <td><strong>Unit Product Price</strong></td>
            </tr>
                 <?php foreach($ordeitem as $ordeitems){
				$ordeitemname = $objReport->GetPageData($ordeitems['product_id']);
						$category_name =  $catname->Get_Category($ordeitemname['category_id']);
						$subcatname =  $catname->Get_Category($ordeitemname['subcat_id']);s
				 ?>
            <tr>
           
       
                   <td><?php echo $category_name ['catname'];?> </td>
                  <td><?php echo $ordeitemname['pname'];?> (<?php echo $subcatname['catname'];?>)</td>
                  <td><?php echo $ordeitems['quantity'];?> </td>
                  <td><?php echo $ordeitems['product_price'];?> </td>
         
             </tr>
             
            
                <?php }?>
                <tr>
                  <td><strong>Order Status</strong></td>
                  <td> <?php foreach($discs as $discsq){ $dis = $disc->GetStatusDetail($discsq['status_id']);echo $dis['status_name'].',&nbsp;';} ?></td>
                     <td> <strong>Sub Total</strong></td>
                        <td> <?php echo $details1[0]['amount']; ?></td>
                    </tr>    
                       <tr>
                         <td><strong>Payment Status</strong></td>
                  <td> <?php echo $details1[0]['payment_status']; ?></td>
                     <td> <strong>GST (Tax) </strong></td>
                        <td> <?php echo $details1[0]['amount']; ?></td>
                    </tr>   
                    
                     <tr>
                 <td><strong>Payment Mode</strong></td>
                  <td> <?php echo $paym['payment_name']; ?></td>
                     <td><strong>Discount</strong></td>
                        <td> <?php echo $details1[0]['discount']; ?></td>
                    </tr>   
                    
                     <tr>
                  <td></td>
                  <td> </td>
                     <td> <strong>Total Amount</strong></td>
                        <td> <?php echo $details1[0]['total_amount']; ?></td>
                    </tr>     
            </table>
            </td>
        
            
        </tr>
        <?php
                } } else {
                ?>
        <tr>
          <td colspan="10" class="align-center">No Order Available !</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
  <div class="entry">
    <div class="pagination"> <?php echo $pagingobj->Pages(); ?> </div>
    <div class="sep"></div>
  </div>
</div>
<!-- End Box --> 
<script>
    function showBox(id){

        $('#content_detail_'+id).toggle();
    }
</script>
<style>
.colsnheading { font-weight:bold;}
#main form select {
    border: 1px solid #999999;
    border-radius: 3px;
    width: 50%;
}
</style>
