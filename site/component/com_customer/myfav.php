<?php $userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
//print_r($userinfo);
$pro = new product();
$usid = $userinfo['user_id'];
$report = new Product();
$report_info = $report->showAllFavbyUser($usid); 

$acts=$_POST['itfactions'];
$ids=implode(',',$_POST['itf_datasid']);
if($acts == 'delete')
	{
		$report->FavDeleteByCustomer($ids);
		flashMsg("My favourite Ad is successfully Deleted");
		redirectUrl(CreateLink(array("customer&mode=myfav")));
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
  <h3>&nbsp;</h3>
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
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">View Details</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1;
						   foreach($report_info as $report_info1) {
							   $imge = explode(',',$report_info1['upload']);
							   $objpro = $pro->showAllProductbyid($report_info1['product_id']);
							   ?>
        <tr>
          <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $report_info1['id']; ?>" class="itflistdatas"/></td>
          <td class="align-center"><?php echo $i++; ?></td>
          <td class="align-center"><?php echo $objpro['name']; ?></td>
          <td class="align-center"><?php echo WordLimit($objpro['logn_desc'],8); ?></td>
          <td class="align-center"><a href="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$report_info1['product_id'])); ?>">View Details</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
  <?php } else { ?>
  <p style="text-align: center;">No Request Available !</p>
  <?php } } ?>
</div>
