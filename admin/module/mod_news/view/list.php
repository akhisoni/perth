<?php
$perpage = $stieinfo['paging_size'] ;//limit in each page

if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts = $_POST['itfactions'];
	$ids = implode(',',$_POST['itf_datasid']);


	if($acts == 'delete')
		$cmsobj->admin_delete($ids);
		flash("Your News has been succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}
$InfoData1 = $cmsobj->ShowAllPageCms();
$urlpath = CreateLinkAdmin(array($currentpagenames))."&";
$pagingobj = new ITFPagination($urlpath,$perpage);
$InfoData = $pagingobj->setPaginateData($InfoData1);

?>

<!-- Box -->
<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo $pagetitle;?></div>
    <!-- Page Heading -->
    <div class="entry top_buttons">
        <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'add')); ?>" class="button add"><span>Add New <?php echo $pagetitle; ?></span></a>
        <a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>
    </div>
    <div class="clear"></div>

    <form id="itffrmlists" name="itffrmlists" method="post" action="">
        <input type="hidden" name="itfactions" id="itfactions" value="" />
        <input type="hidden" name="itf_status" id="itf_status" value="" />
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

        <thead>

        <tr>
            <th scope="col">&nbsp;<input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
            <th scope="col">Name</th>
            <th scope="col" width="10%">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Modify</th>
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
                    <?php 	echo WordLimit($InfoData[$i]['pagetitle']); ?>		</td>
                 <td align="left">
                    <?php if($InfoData[$i]['newsimage']) { ?>
                    <img class="zoomq" src="<?php echo PUBLICPATH."newsimage/".$InfoData[$i]['newsimage']; ?>" height="40" width="40"/>
                    <?php } else { ?>
                        <img src="<?php echo PUBLICPATH.'newsimage/no_image.jpg'; ?>" height="40" width="40"/>
                    <?php } ?>
                    </td>
                <td class="align-left">
                    <?php echo WordLimit($InfoData[$i]['description']); ?>		</td>
                <td class="align-center">
                    <a href="#itf" class="activations" rel="<?php echo $InfoData[$i]['id']; ?>" rev="newspage"><img src="imgs/<?php echo $InfoData[$i]['status']; ?>.png" /></a>
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
<script>$(document).ready(function() {
    var table = $('#example').DataTable( {
        fixedHeader: true
    } );
} );</script>
<!-- End Box -->