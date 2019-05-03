<?php session_start(); 
 
 if(isset($_REQUEST['uid'])){$uid=$_REQUEST['uid'];}
 else {$uid= $_SESSION['FRONTUSER']['id']; }

$msgs="Login";
require('../itfconfig.php');
$obj = new Quote();$objProduct = new Product();$objCategory = new Category();
if(isset($_REQUEST['id']) && !empty($_REQUEST['id']) ){
    
            $quote_info = $obj->checkQuote2($_REQUEST['id'],$uid);
    $results = $obj->getQuoteDetails($_REQUEST['id']);
}
//echo "<pre>";print_r( $quote_info);
//$bids = $obj->getBidsByQuote($quote_info['id']);

$bids = $obj->getDetailFromPayment($quote_info['id'], $uid);
//$bids = $obj->getDetailFromPayment($quote_info['id'],$uid);
//echo $_SESSION['FRONTUSER']['id'];die;
//echo "<pre>";print_r($bids);die;
//foreach($bids as $bid){
//    $supplier_id[] = $bid['supplier_id'];
//    $bid_price[] = Currency($bid['bid_amount']);
//}
$def_chat = $obj->getActiveQuoteChat($quote_info['id'],$quote_info['customer']);
//print_r($results);
?>


<div class="work_area">
    <h3>Work Area</h3><form id="work_area1" name="work_area1" method="post" action="">
    <div class="box">
         <input type="hidden" value="<?php echo $quote_info['bid_id']; ?>" id="bid_id" name="bid_id">
         <input type="hidden" value="<?php echo $quote_info['quote_name']; ?>" id="bid_submit" name="bid_submit">
        <p><span class="left">Enquiry Detail:</span> <span class="right"><?php echo $quote_info['quote_name']; ?></span></p>
          <input type="hidden" value="<?php echo $quote_info['id']; ?>" id="quote_id" name="quote_id">
          
          
               <?php if($quote_info['service']!='') { echo "<p><label class='left'>Product Category : </label>";
                   $sql = "SELECT * FROM `itf_service_category`WHERE id IN ( ".$quote_info['service']." )";
                    $res = mysql_query($sql);                  
                    while($datas = mysql_fetch_assoc($res)){ 
                    ?>                
                <span class="right"><?php echo $datas['catname'];  ?> 
               <?php $sqlp = "SELECT * FROM `itf_service_category`WHERE id = ".$datas['parent']; 
                     $resp = mysql_query($sqlp); 
                     $datasp = mysql_fetch_assoc($resp);
                    // echo "<span>";
                   if($datasp){echo "Parent :".$datasp['catname']."<br>";}
                     // echo "....................................";
                     // echo "</span>";
               ?>
                </span>
                <?php  }}
                else{ echo "<p><label class='left'>Parent Hierarchy  </label>";
                    $productInfo = $objProduct->CheckProduct($quote_info['product_id']);                
                $breadcrumb = $objCategory->getQuoteProductParentHierarchy($productInfo['category_id']);
                echo $breadcrumb; 
                }
?></p> 
          
          
          
        <p><span class="left">Quote Details:</span> 
            <span class="right"><a href="#itf" title="click for detail" onclick="showQuoteDetails1(<?php echo $quote_info['id']; ?>)"><?php echo $quote_info['logn_desc']; ?></a></span></p>
        
        <?php if($quote_info['special_req']!=''){?> 
        <p><span class="left">Advise Delivery Area:</span> <span class="right"><?php echo $quote_info['special_req']; ?></span></p>
        <?php }?>
        <?php if($_SESSION['FRONTUSER']['usertype'] == 3) { ?>
            <p><span class="left">Quote Created By:</span> <span id="receid" class="right"><a href='#' onclick='customerreview("<?php echo $quote_info['customer']; ?>");'><?php echo $quote_info['customer']; ?></a></span></p>
            <p>
                <span class="left">Job Status: </span>
                <span class="right"><?php echo $obj->getQuoteStatus($quote_info['quote_status']); ?></span>
            </p>
        <?php } else { ?>
     <p><span class="left">Selected Seller ID: </span> <span id="receid" class="right"><a href='#' onclick='suppreviews("<?php echo $bids['registration_id']; ?>");'><?php  echo $bids['registration_id'];  //echo implode(",",$supplier_id); ?></a></span></p>
            <p><span class="left">Seller Price: </span> <span class="right">$<?php echo $bids['bid_amount'];  //echo implode(",",$bid_price); ?></span></p>
            <p><span class="left">Job Status: </span>
            <input type="radio" value="0" name="quote_status" onclick="document.work_area1.submit();" <?php  if($quote_info['bid_closed'] == 0){ echo "checked=true"; } ?>><label>In Progress</label>
            <input type="radio" value="1"  name="quote_status" onclick="document.work_area1.submit();" <?php if($quote_info['bid_closed'] == 1){ echo "checked=true"; } ?>><label>Pending</label>
            <input type="radio" value="2"  name="quote_status" onclick="document.work_area1.submit();" <?php if($quote_info['bid_closed'] == 2){ echo "checked=true"; } ?>><label>Complete</label>
        </p>
        <?php } ?>
    </div></form>
</div>
<br>
<hr><form id="work_area" method="post" action="">
<div class="message_box">
    <input type="hidden" value="<?php echo $quote_info['id']; ?>" id="quote_id" name="quote_id">
     <input type="hidden" value="<?php echo $quote_info['bid_id']; ?>" id="bid_id" name="bid_id">
      <input type="hidden" value="<?php echo $quote_info['quote_name']; ?>" id="quote_name" name="quote_name">
     <?php if($_SESSION['FRONTUSER']['usertype'] == 3) { ?>
    <input type="hidden" value="<?php echo $quote_info['customer'];  ?>" id="reciever_id" name="reciever_id">
    <?php } else { ?>
     <input type="hidden" value="<?php  echo $bids['registration_id'];  ?>" id="reciever_id" name="reciever_id">
          <?php } ?>
    <label>Message <span class="required">*</span></label>
    <textarea name="chat_text" id="chat_text"></textarea>
    <input type="button" value="Submit" onclick="showchat()" >
    <input type="button" class="button" id="active_back" onClick='activeback();' value="Back">

</div>
<div id='defchat'>
<?php if(count($def_chat) > 0) { ?>
<?php foreach($def_chat as $result) { 

pr($result);

?>
<div class="board_cont_user">
    <img src="<?php echo PUBLICPATH."/profile/"; ?><?php if($result['profile_image']){ echo $result['profile_image'];} else { echo 'no_image.jpg'; }; ?>">
    <p><span><?php echo $result['name']; ?></span><label><?php echo date('d M Y h:i A',$result['added_date']); ?></label><br><?php echo $result['chat_text']; ?></p>
    <div class="clear"></div>
</div>
<?php }  } else { ?>
    <div class="board_cont_user">
        <p>No Conversation here !</p>
        <div class="clear"></div>
    </div>

<?php } ?>
</div>
<div class="board_cont message_content" id="board_cont"> </div>
</form>
<div id="mydialogs" title="Supplier Detail" style="display:none;">
    <p>Supplier Detail</p>       
</div>
<div id="mydialogs1" title="Customer Detail" style="display:none;">
    <p>Customer Detail</p>       
</div>
<div class="clear"></div>

<script type="text/javascript">

    function showchat(){
     
    
       if($('#chat_text').val() == ''){
            alert('Please enter text.')
            $('#chat_text').focus();
        } else {
            $.ajax({
                url: "<?php echo SITEURL; ?>/itf_ajax/active_quote_chat.php",
                type :"POST",
                data: $('#work_area').serialize(),
                success:function(msg){
                    $("#board_cont").html(msg);
                    $("#chat_text").val('');
					$("#defchat").hide();
                }
            });
        }

    }


    $(function(){
       function quoteload(){
        var id = $("#quote_id").val();
        
        var reciever_id=   $('#receid').html();
        
      
        $.ajax({
            url: "<?php echo SITEURL; ?>/itf_ajax/active_quote_chat.php",
            type :"POST",
            data: 'quote_id='+id+'&reciever_id='+reciever_id,
           
            success:function(msg){
                $("#board_cont").html(msg);
                $("#chat_text").val('');
				$("#defchat").hide();
            }
        });}
         quoteload();
         
           function quoteload1(){
        var id = $("#quote_id").val();
        
        var reciever_id=   $('#receid').html();
        
      
        $.ajax({
            url: "<?php echo SITEURL; ?>/itf_ajax/active_quote_chat.php",
            type :"POST",
            data: 'quote_id='+id+'&reciever_id='+reciever_id,
           
            success:function(msg){
                $("#board_cont").html(msg);
				$("#defchat").hide();
              
            }
        });}
         setInterval(function(){quoteload1();},3000); 

        $('#active_back').click(function() {
            $("#active_quotes").hide();
            $("#quote_active").show();
			window.location.reload(true);
        });

    });
	
	function activeback()
		{
		window.location.reload(true);
		}
	function suppreviews(id)
	{
	    $.post("<?php echo SITEURL; ?>/itf_ajax/index.php",  { reviewid: id},	
	function(result){
          //alert(result);	
				$("#mydialogs").dialog({width: 500,modal: true}).addClass('greenbox');
                 ChangeMessage(result); 
				return false; 
			});
	}
    function customerreview(id)
	{
	    $.post("<?php echo SITEURL; ?>/itf_ajax/index.php",  { reviewid: id},	
	function(result1){
          //alert(result1);	
				$("#mydialogs1").dialog({width: 500,modal: true}).addClass('greenbox');
                 //alert(result1);
				 ChangeMessage1(result1); 
				
				return false; 
			});
	}
	
	function ChangeMessage(Message) {           
            $("#mydialogs").html(Message);
}
		
		function ChangeMessage1(Message) {           
            $("#mydialogs1").html(Message);
}
		
		
		
</script>