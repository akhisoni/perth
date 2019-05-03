<?php

$perpage = 10;//limit in each page

if(isset($_POST['itf_datasid'],$_POST['itfactions']))

{

	$acts=$_POST['itfactions'];

	$ids=implode(',',$_POST['itf_datasid']);





	if($acts=='delete')

		//echo "<pre>";print_r($ids); die;
		$packageobj->admin_delete($ids);

		flash("Your package has been succesfully deleted");

		redirectUrl("itfmain.php?itfpage=".$currentpagenames);

}

$InfoData1 = $packageobj->ShowAllPackage();

$urlpath=CreateLinkAdmin(array($currentpagenames))."&";

$pagingobj=new ITFPagination($urlpath,$perpage);

$InfoData=$pagingobj->setPaginateData($InfoData1);

//itfmain.php?itfpage=cmslist&ID=25

?>

<div class="full_w">
 <div class="h_title"><?php echo $pagetitle;?></div>
 
 <div class="entry top_buttons">
        <a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'add')); ?>" class="button add"><span>Add New <?php echo $pagetitles; ?></span></a>
        <a onclick="return itfsubmitfrm('delete','itffrmlists');" class="button cancel"><span>Delete</span></a>
      

    </div>
 

 <div class="clear"></div>

						<form id="itffrmlists" name="itffrmlists" method="post" action="">

						<input type="hidden" name="itfactions" id="itfactions" value="" />

						<input type="hidden" name="itf_status" id="itf_status" value="" />

                      <table>
                    
                        <thead>  <tr>
                    
                          <th scope="col">&nbsp;<input name="selectalls" id="selectalls" type="checkbox" value="0" /></th>
                    
                     <th scope="col">Package Name</th>
                          
                        <th scope="col">Package Duration</th>
                         
                        <th scope="col">Package Prices</th> 
                              
                    
                 <th scope="col">Status</th>
                    
                      <th scope="col">Action</th>
                    
                       </tr>
                     </thead>
                     <tbody>
                        <?php
                     if(count($InfoData) > 0){
                        for($i=0;$i<count($InfoData);$i++)
                    
                        {
                    
                        ?>
                    
                        <tr class="<?php echo ($i%2==0)?"odd":"";?>" >
                    
                        <td align="left"><input name="itf_datasid[]" type="checkbox" value="<?php echo $InfoData[$i]['id']; ?>" class="itflistdatas"/></td>
                    
                          <td>
                    
                           <?php 	echo $InfoData[$i]['package_name']; ?>		</td>
                           
                            
                            <td align="center">
                    
                           <?php 	echo $InfoData[$i]['package_duration']; ?>		</td>
                    
                             <td align="center">
                    
                           <?php 	echo $InfoData[$i]['package_prices']; ?>		</td>
                            <td align="center">
                    
                            <a href="#itf" class="activations" rel="<?php echo $InfoData[$i]['id']; ?>" rev="packagelist"><img src="imgs/<?php echo $InfoData[$i]['status']; ?>.png" /></a>
                    
                            </td>
                    
                          <td align="center"><a href="<?php echo CreateLinkAdmin(array($currentpagenames,'actions'=>'edit','id'=>$InfoData[$i]['id'])); ?>" title="Edit Package" alt="Package"><img src="imgs/itf_edit.png" border="0" /></a>	  </td>
                    
                        </tr>
                    
                         <?php
						}} else {
        ?>
            <tr>
                <td colspan="10" class="align-center">No Record Available !</td>
            </tr>
        <?php } ?>
                   </tbody> 
                    </table>

 </form>

	<!-- Pagging -->

		   <div class="entry">
        <div class="pagination">
            <?php echo $pagingobj->Pages(); ?>
        </div>
        <div class="sep"></div>
    </div>
 

</div>
