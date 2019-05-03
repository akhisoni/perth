<?php $userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
//print_r($userinfo);
$usid = $userinfo['user_id'];

$report = new Report();
$report_info = $report->showAllEnquiryFrontbyUser($usid); 

$acts=$_POST['itfactions'];
$ids=implode(',',$_POST['itf_datasid']);
if($acts == 'delete')
	{
		$report->RequestDeleteByCustomer($ids);
		flash("Buying Request is successfully Deleted");
		redirectUrl(CreateLink(array("supplier&mode=mybuyingrequest	")));
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
        <h3>My Buying Request</h3>
         <a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>
           <?php if(isset($report_info)){ if(count($report_info) > 0) { ?>
 <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />

          <table class="view_request_css">
 <thead>

            <tr>
             <th scope="col">&nbsp;</th>
                 <th scope="col">Id</th>
               <th scope="col">Buyer Name</th>
                 <th scope="col">Email Id</th>
             <!--   <th scope="col">Description</th>-->
                    <th scope="col">Location</th>
                     <th scope="col">Catalogue Category</th>
                       <th scope="col">Catalogue Name</th>
                <th scope="col">View Details</th>
            </tr>
            </thead>
            
                          <tbody>
                          <?php $i=1;
						   foreach($report_info as $report_info1) {
							   $imge = explode(',',$report_info1['upload']);
							   ?>
                                <tr>
                                                                 <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $report_info1['id']; ?>" class="itflistdatas"/></td>

                    <td class="align-center"><?php echo $i++; ?></td>
                        <td class="align-center"><?php echo $report_info1['name']; ?></td>
                         <td class="align-center"><?php echo $report_info1['email']; ?></td>
                        <!--  <td class="align-center"><?php echo $report_info1['description']; ?></td>-->
                           <td class="align-center"><?php echo $report_info1['location']; ?></td>
                         <td class="align-center"><?php echo $report_info1['catalog_category']; ?></td>
                                  <td class="align-center"><?php echo $report_info1['catalog_name']; ?></td>
                        <td class="align-center">  <a href="<?php echo CreateLink(array('supplier','mode'=>'details','id'=>$report_info1['id'])); ?>">View Details</a>   <?php /*?> <?php $i=1;foreach($imge as $imagevalue){?>

             <a href="<?php echo PUBLICPATH."buying_request_file/".$imagevalue; ?>" target="_blank"><?php echo $imagevalue; ?><?php echo $i++;?> | </a>
               <?php } ?><?php */?>
                                               
                                                </td>
                
                    </tr>
                               
                <?php } ?>
            </tbody>
            
            
</table>
</form>

      
        

        <?php } else { ?>
            <p style="text-align: center;">No Request Available !</p>
        <?php } } ?>
    </div>