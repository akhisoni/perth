<?php 
if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$userids=isset($_POST['itf_datasid'])?$_POST['itf_datasid']:"0";
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);
	if($acts=='delete')
	{
		$objmodule->adminDelete($ids);
		flash("Faculty is successfully Deleted");
	}

	redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}
$perpage = isset($stieinfo["paging_size"])?$stieinfo["paging_size"]:'10';
$urlpath=CreateLinkAdmin(array($currentpagenames))."&";
$InfoData1 = $objmodule->showAll();
$pagingobj=new ITFPagination($urlpath,$perpage);
$InfoData=$pagingobj->setPaginateData($InfoData1);

?>
<div class="full_w"> 
  <!-- Page Heading -->
  <div class="h_title"><?php echo $pagetitle;?></div>
  <div class="entry top_buttons">
<a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'add')); ?>" class="button add"><span>Add new <?php echo $pagetitle; ?></span></a> 
<a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>

</div>  <div class="clear"></div>

			
				
		
						<form id="itffrmlists" name="itffrmlists" method="post" action="">
<input type="hidden" name="itfactions" id="itfactions" value="" />
<input type="hidden" name="itf_status" id="itf_status" value="" />
 <table>    <tr>
      <th width="5%" align="center" ><input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
      <th width="15%" align="left">Discount Code</th>
 	<th width="15%" align="center">Discount Price</th>
 	<th width="15%" align="center">Discount Percent</th>
     	<th width="15%" align="center">Start Date</th>
         	<th width="15%" align="center">End Date</th>
<th width="9%"  align="center">Action</th>
<th width="9%"  align="center">Edit</th>
   </tr>
	<?php
	//echo "<pre>"; print_r($InfoData); die;
	foreach($InfoData as $k=>$itfdata)
	{
	?>
    <tr class="<?php echo ($k%2==0)?"rowsfirst":"rowssec";?>" >
      <td align="left"><input name="itf_datasid[]" type="checkbox" value="<?php echo $itfdata['id']; ?>" class="itflistdatas" /></td>
	   <td  align="left" ><?php echo $itfdata['discount_code']; ?></td>
   
       <td align="left"><?php echo $itfdata['discount_price']; ?></td>
            <td align="left"><?php echo $itfdata['discount_percent']; ?></td>
                 <td align="left"><?php echo $itfdata['start_date']; ?></td>
                      <td align="left"><?php echo $itfdata['end_date']; ?></td>
       <td align="center"><a href="#itf" class="activations" rel="<?php echo $itfdata['id']; ?>" rev="moddiscount"><img src="imgs/<?php echo $itfdata['status']; ?>.png" /></a></td>
   <td align="center">
   <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'edit','id'=>$itfdata['id'])); ?>" title="Edit Category " alt="Edit Category"><img src="imgs/itf_edit.png" border="0" /></a>   </td>
    </tr>
	<?php
	}
	?>
</table>
 </form>
		<!-- Pagging -->
		<div class="pagging">
		<div class="right">
		<?php echo $pagingobj->Pages(); ?>
		</div>
		</div>
		<!-- End Pagging -->
	
</div>