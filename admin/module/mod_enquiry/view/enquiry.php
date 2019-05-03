<?php
$perpage = $stieinfo['paging_size'] ;//limit in each page

if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);

	if($acts=='delete')
        $objReport->deleteOrder($ids);
		flash("Enquiry is succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}

$InfoData1 = $objReport->showAllEnquiries();

$urlpath = CreateLinkAdmin(array($currentpagenames))."&";
$pagingobj = new ITFPagination($urlpath,$perpage);
$InfoData = $pagingobj->setPaginateData($InfoData1);

$quote = new Quote();
$totalcount = $objReport->getTotalCustomerEnquiry();
$totitem = $totalcount[0]['count(*)']; 

//echo "<pre>"; print_r($totitem); die;

?>

<!-- Box -->
<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo $pagetitle;?></div>
    <!-- Page Heading -->
   <div class="entry top_buttons">
        <a href="all_customer_enquiry.php"  class="button"><span>Download Enquiry</span></a>
    </div>
    <div class="clear"></div>
 <p style="font-size:16px; line-height:20px;">
                Total Enquiry:   <b style="color:#B52421;"><?php echo $totitem; ?></b>
                
                </p>

    <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />
        <table>
            <thead>

            <tr>
                 <th scope="col">&nbsp;<input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
               <!--<th scope="col"> Name</th>-->
             
               
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                 <th scope="col">Phone</th>
               <th scope="col">Message</th>
               <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if(count($InfoData) > 0){
                for($i=0;$i<count($InfoData);$i++)
                {
					$imge = explode(',',$InfoData[$i]['upload']);
                    
					?>
                    <tr>
                    <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $InfoData[$i]['id']; ?>" class="itflistdatas"/></td>
                
                       
                        <td class="align-center"><?php echo $InfoData[$i]['name']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['email']; ?></td>
                          <td class="align-center"><?php echo $InfoData[$i]['phone']; ?></td>
                         <td class="align-center"><?php echo $InfoData[$i]['message']; ?></td>
                        <td class="align-left"><?php echo $InfoData[$i]['date_added']; ?></td>
                      
                       <td class="align-center">
                       <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'edit','id'=>$InfoData[$i]['id'])); ?>" title="Edit" alt="Edit"><img src="img/view.png" border="0" /></a>	  </td>
                    </tr>
                 
                <?php
                } } else {
                ?>
                <tr>
                    <td colspan="10" class="align-center">No Record Available !</td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </form>

    <div class="entry">
        <div class="pagination">
            <?php echo $pagingobj->Pages(); ?>
        </div>
      
    </div>


</div>
<!-- End Box -->

<script>
    function showBox(id){

        $('#content_detail_'+id).toggle();
    }
</script>