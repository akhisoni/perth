<?php

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
  $InfoData1 = $objReport->getOrderlistByAdmin();
}





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
  <div class="h_title"><?php echo $pagetitle;?></div>
  <!-- Page Heading -->

  <div class="entry top_buttons">
   
     <!--<form id="itffrmsearch" name="itffrmsearch" method="post" action="<?php echo CreateLinkAdmin(array($currentpagenames,'search'=>'text')); ?>">

				<label>Search <?php echo $pagetitle; ?></label>
         <select name="seller_id" id="seller_id">
      <option value="">--Select Vendor--</option>       
       <?php foreach($itfUserdata as $itfUser) {?>
       <option value="<?php echo $itfUser['id'];?>"<?php if($ItfInfoData["seller_id"] == $itfUser['id']){ echo"selected";} ?>><?php echo $itfUser['name'];?> (<?php echo $itfUser['company_name'];?>)</option>
       <?php } ?>
       </select>
				<input type="hidden" name="itfpage" value="<?php echo $currentpagenames; ?>" />

				<input name="txtsearch" type="text" id="txtsearch" class="field small-field" value="<?php echo isset($_SESSION['SEARCHDATA']['txtsearch'])?$_SESSION['SEARCHDATA']['txtsearch']:""; ?>" />
				<input name="searchuser" type="submit" id="searchuser"class="button" value="Search" />

				</form>-->
    </div>
  <div class="clear"></div>
  <form id="itffrmlists" name="itffrmlists" method="post" action="">
    <input type="hidden" name="itfactions" id="itfactions" value="" />
    <input type="hidden" name="itf_status" id="itf_status" value="" />
    <table id="datatable" class="display" cellpadding="1" cellspacing="1"  width="100%">
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
          <td class="align-center"><?php echo $InfoData[$i]['total_amount']; ?></td>
          <td class="align-center"><?php echo $InfoData[$i]['order_status']; ?></td>
          <td class="align-center"><?php echo  $InfoData[$i]['date_added']; ?></td>
          <td class="align-center"><a href="#itf" onclick="showBox(<?php echo $InfoData[$i]['id']; ?>);" title="Edit" alt="Edit"><img src="img/view.png" border="0" /></a></td>
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
    <div class="pagination"> <?php //echo $pagingobj->Pages(); ?> </div>
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

<script>$(document).ready(function() {
    $('#datatable').DataTable();
} );</script>
