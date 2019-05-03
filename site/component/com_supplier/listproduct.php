<?php 
$proobj = new Product();
$InfoData1 = $proobj->ShowAllProductSeller();
$acts=$_POST['itfactions'];
$ids=implode(',',$_POST['itf_datasid']);
if($acts == 'delete')
	{
		$proobj->seller_product_delete($ids);
		flash("Catalogue is successfully Deleted");
		redirectUrl(CreateLink(array("supplier&mode=listproduct")));
	}

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
<h3>My Catalogues</h3><br/>
<a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>



 <?php if(isset($InfoData1)){ if(count($InfoData1) > 0) { ?>
           
              <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />

          <table class="view_request_css">
 <thead>

            <tr>
              <th scope="col">&nbsp;<!--<input name="selectalls" id="selectalls" type="checkbox" value="0" />--></th>
                 <th scope="col">Id</th>
               <th scope="col">Catalogue Name</th>
               <th scope="col">Code</th>
               <th scope="col">Description</th>
                <th scope="col">Action</th>

    
            </tr>
            </thead>
            
                          <tbody>
                          <?php $i=1;
						   foreach($InfoData1 as $report_info1) {?>
                                <tr>
                                 <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $report_info1['id']; ?>" class="itflistdatas"/></td>
                    <td class="align-center"><?php echo $i++; ?></td>
                        <td class="align-center"><?php echo $report_info1['name']; ?></td>
                          <td class="align-center"><?php echo $report_info1['code']; ?></td>
                            <td class="align-center"><?php echo $report_info1['logn_desc']; ?></td>
                         <td class="align-center"><a href="<?php echo CreateLink(array('supplier','mode'=>'addproduct','id'=>$report_info1['id']));?>">Edit</a></td>
                        
                                               
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