<?php 
$usid = $_SESSION['FRONTUSER']['id'];
$objquote = new Quote();
$InfoData1 = $objquote->getQuotebySeller($usid);

?>

<script>
function  itfsubmitfrm(act,frmname)
{
	if(act=='delete'){
	if(!$('#'+frmname+' input[type="checkbox"]').is(':checked'))
	{
		alert("Please select at least one record");
		return false;
	}
	else if(!confirm("Do you want to delete"))
		return false;
	}
	document.getElementById('itfactions').value=act;
	document.getElementById(frmname).submit();
}
	
</script>
<div class="buying_request">
<h3>My Offer</h3><br/>




 <?php if(isset($InfoData1)){ if(count($InfoData1) > 0) { ?>
           
              <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />

          <table class="view_request_css">
 <thead>

            <tr>
                 <th scope="col">Id</th>
               <th scope="col">Catalogue Category</th>
               <th scope="col">Catalogue</th>
               <th scope="col">Location</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>


    
            </tr>
            </thead>
            
                          <tbody>
                          <?php $i=1;
						   foreach($InfoData1 as $report_info1) {?>
                                <tr>
                    <td class="align-center"><?php echo $i++; ?></td>
                        <td class="align-center"><?php echo $report_info1['catalog_category']; ?></td>
                          <td class="align-center"><?php echo $report_info1['catalog_name']; ?></td>
                            <td class="align-center"><?php echo $report_info1['location']; ?></td>
                                             <td class="align-center"><?php echo $report_info1['description']; ?></td>
                         <td class="align-center"><a href="<?php echo CreateLink(array('supplier','mode'=>'viewchat','id'=>$report_info1['quote_id'],'repid'=>$report_info1['usid']));?>">View Message</a></td>
                        <td class="align-center"><a href="<?php echo CreateLink(array('view_request','itemid'=>'view_detail','id'=>$report_info1['quote_id']));?>">View Details</a></td>
                                               
                                                </td>
                
                    </tr>
                               
                <?php } ?>
            </tbody>
            
            
</table>
</form>

      
        

        <?php } else { ?>
            <p style="text-align: center;">No Product Available !</p>
        <?php } } ?>

</div>