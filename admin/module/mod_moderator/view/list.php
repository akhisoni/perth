<?php
$perpage = $stieinfo['paging_size'] ;//limit in each page
$pagetitles='Customers';
if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);

	if($acts=='delete')
		$userobj->user_delete($ids);
		flash("Moderator is succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}

if(isset($_REQUEST['txtsearch']) and !empty($_REQUEST['txtsearch']))
{
	$InfoData1 = $userobj->ShowAllModeratorSearch($_REQUEST['txtsearch']);
}
else
{
	$InfoData1 = $userobj->ShowAllModerator();
}

$urlpath=CreateLinkAdmin(array($currentpagenames))."&";
$pagingobj=new ITFPagination($urlpath,$perpage);
$InfoData=$pagingobj->setPaginateData($InfoData1);
?>

<!-- Box -->
<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo $pagetitles;?></div>
    <!-- Page Heading -->
    <div class="entry top_buttons">
        <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'add')); ?>" class="button add"><span>Add New <?php echo $pagetitle; ?></span></a>
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
                <th scope="col">Name</th>
                <th scope="col">Email Id</th>
                <th scope="col">Status</th>
                <th scope="col" style="width: 65px;">Modify</th>
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
                        <td class="align-left">
                            <span class="pname"><?php echo $InfoData[$i]['name']; ?></span></td>
                        <td class="align-left"><?php echo $InfoData[$i]['email']; ?></td>
                        <td class="align-center">
                            <a href="#itf" class="activations" rel="<?php echo $InfoData[$i]['id']; ?>" rev="user"><img src="imgs/<?php echo $InfoData[$i]['status']; ?>.png" /></a>
                        </td>
                        <td class="align-center"><a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'edit','id'=>$InfoData[$i]['id'])); ?>" title="Edit" alt="Edit"><img src="img/i_edit.png" border="0" /></a>	  </td>
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