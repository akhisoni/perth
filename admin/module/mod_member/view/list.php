<?php
$perpage = $stieinfo['paging_size'] ;//limit in each page
$pagetitles='Members';
if(isset($_POST['itf_datasid'],$_POST['itfactions']))
{
	$acts=$_POST['itfactions'];
	$ids=implode(',',$_POST['itf_datasid']);

	if($acts=='delete')
		$userobj->user_delete($ids);
		flash("User is succesfully deleted");
		redirectUrl("itfmain.php?itfpage=".$currentpagenames);
}

if(isset($_REQUEST['search']) and !empty($_REQUEST['search']))

{

if(isset($_POST['txtsearch'])) $_SESSION['SEARCHDATA']=$_POST;

	
	
	
	$InfoData1 = $userobj->ShowAllCustomerSearch($_SESSION['SEARCHDATA']['txtsearch']);	
  
  
	$urlpath=CreateLinkAdmin(array($currentpagenames,"search"=>"text"))."&";
}
else
{


	unset($_SESSION['SEARCHDATA']);
$InfoData1 = $userobj->ShowAllMember();
	$urlpath=CreateLinkAdmin(array($currentpagenames))."&";
	
}
$perpage=20;

$urlpath=CreateLinkAdmin(array($currentpagenames))."&actions=member&";
$pagingobj=new ITFPagination($urlpath,$perpage);
$InfoData=$pagingobj->setPaginateData($InfoData1);
?>

<!-- Box -->
<div class="full_w">
    <!-- Page Heading -->
    <div class="h_title"><?php echo $pagetitles;?></div>
    <!-- Page Heading -->
    <div class="entry top_buttons">
      <a href="./exallmem.php" class="button excel"><span>Export to excel</span></a>
       <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'import')); ?>" class="button excel"><span>Import</span></a>
        <a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>
        <p>&nbsp;</p>
       <form id="itffrmsearch" name="itffrmsearch" method="post" action="<?php echo CreateLinkAdmin(array($currentpagenames,'search'=>'text')); ?>">

				<label>Search <?php echo $pagetitle; ?></label>

				<input type="hidden" name="itfpage" value="<?php echo $currentpagenames; ?>" />

				<input name="txtsearch" type="text" id="txtsearch" class="field small-field" value="<?php echo isset($_SESSION['SEARCHDATA']['txtsearch'])?$_SESSION['SEARCHDATA']['txtsearch']:""; ?>" />

				<input name="searchuser" type="submit" id="searchuser"class="button" value="Search" />

				</form>
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
                <th scope="col">User Type</th>
                <th scope="col">Status</th>
                <th scope="col" style="width: 65px;">Modify</th>
            </tr>
            </thead>

            <tbody>
            
			<?php
            if(count($InfoData) > 0){
                for($i=0;$i<count($InfoData);$i++)
                {
				 $type= $InfoData[$i]['usertype'];
                    ?>
                    <tr>
                        <td class="align-center"><input name="itf_datasid[]" type="checkbox" value="<?php echo $InfoData[$i]['id']; ?>" class="itflistdatas"/></td>
                        <td class="align-left">
                            <span class="pname"><?php echo $InfoData[$i]['name']; ?></span></td>
                        <td class="align-left"><?php echo $InfoData[$i]['email']; ?></td>
                        
                        
                        <td class="align-left"><?php echo  $InfoData[$i]['usertype']; ?></td>
                       
                        
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