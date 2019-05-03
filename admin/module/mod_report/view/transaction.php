<?php
$perpage = $stieinfo['paging_size'] ;//limit in each page

if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);

	if($acts=='delete')
        $objReport->deleteOrder($ids);
		flash("Transaction is succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames.'&actions=transaction');
}

$InfoData1 = $objReport->showAllTransactions();

$urlpath = CreateLinkAdmin(array($currentpagenames))."&actions=transaction&";
$pagingobj = new ITFPagination($urlpath,$perpage);
$InfoData = $pagingobj->setPaginateData($InfoData1);

//echo "<pre>"; print_r($InfoData); die;
?>

<!-- Box -->
<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo 'Transaction '.$pagetitle;?></div>
    <!-- Page Heading -->
    <div class="entry top_buttons">
        <a href="<?php echo CreateLinkAdmin(array('report','actions'=>'export','rep'=>'transaction')) ?>" class="button excel"><span>Export to excel</span></a>
        <a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>
    </div>
    <div class="clear"></div>

    <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />
        <table>
            <thead>

            <tr>
                <th scope="col">&nbsp;<input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
                <th scope="col">Order Id</th>
                <th scope="col">Amount</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Payment User</th>
                <th scope="col">Transaction Id</th>
                <th scope="col">User ID</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if(count($InfoData) > 0){
                for($i=0;$i<count($InfoData);$i++)
                {
                    ?>
                    <tr>
                        <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $InfoData[$i]['id']; ?>" class="itflistdatas"/></td>
                        <td class="align-left"><?php echo $InfoData[$i]['id']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['payment_amount']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['date_added']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['payer_email']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['txn_id']; ?></td>
                        <td class="align-center"><?php echo $InfoData[$i]['payer_id']; ?></td>
                        <td class="align-center"><?php echo  $InfoData[$i]['payment_status']; ?></td>
                                        <td class="align-center"><a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'view','id'=>$InfoData[$i]['id'])); ?>" title="Show Detail" alt="Show Detail"><img src="img/i_edit.png" border="0" /></a>	  </td>

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
        <div class="sep"></div>
    </div>


</div>
<!-- End Box -->