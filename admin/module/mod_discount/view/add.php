<script type="text/javascript">
$(document).ready(function() {
	$("#itffrminput").validate({
	rules: {
			discount_code: "required",
			discount_price: "required",
			start_date: "required",
			end_date: "required",
		},
		messages: {
			discount_code: "Please enter discount code",
			discount_price: "Please enter discount price",
			start_date: "Please enter start date",
		      end_date: "Please enter end date"	
			},
	});
});
</script>
<?php
if(isset($_POST['id']))
{
	$userids=$_POST['id'];
	if(!empty($_POST['id']))
	{
		$objmodule->adminUpdate($_POST);
		flash("Discount is successfully Updated");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
	else
	{
		$objmodule->adminAdd($_POST);
		flash("Discount is successfully added");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
	}
}




$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $objmodule->checkData($ids);
?>
<div class="full_w">
	<!-- Page Heading -->
    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>
					<!-- End Box Head -->

	<form action="" method="post" name="itffrminput" id="itffrminput">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />


    <div class="element">
        <label>Discount Code<span class="red">(required)</span></label>
        <input class="text" name="discount_code" type="text"  id="discount_code" size="35" value="<?php echo isset($ItfInfoData['discount_code'])?$ItfInfoData['discount_code']:'' ?>" />
    </div>

 
      <div class="element">
        <label>Discount Price<span class="red">(required)</span></label>
        <input class="text" name="discount_price" type="text"  id="discount_price" size="35" value="<?php echo isset($ItfInfoData['discount_price'])?$ItfInfoData['discount_price']:'' ?>" />
    </div>
    
<div class="element">
        <label>Discount Percent(%)</label>
        <input class="text" name="discount_percent" type="text"  id="discount_percent" size="35" value="<?php echo isset($ItfInfoData['discount_percent'])?$ItfInfoData['discount_percent']:'' ?>" />
    </div>
    
   
    
     <div class="element">
        <label>Discount Description</label>
        <input class="text" name="discount_desc" type="text"  id="discount_desc" size="35" value="<?php echo isset($ItfInfoData['discount_desc'])?$ItfInfoData['discount_desc']:'' ?>" />
    </div>
    <div class="element">
        <label>Start Date</label>
        <input class="text tcal" name="start_date" type="text" id="start_date" size="35" value="<?php echo isset($ItfInfoData['start_date'])?$ItfInfoData['start_date']:'' ?>" />
    </div>

    <div class="element">
        <label>End Date</label>
      <input class="text tcal" name="end_date" type="text"  id="end_date" size="35" value="<?php echo isset($ItfInfoData['end_date'])?$ItfInfoData['end_date']:'' ?>" />
    </div>

   

<!-- Form Buttons -->
    <div class="entry">
        <button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
    </div>
<!-- End Form Buttons -->
</form>	
</div>