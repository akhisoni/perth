<?php 
$id = isset($_GET['id'])?$_GET['id']:'';
$prodobj = new Product();
$stateobj = new State();
$objreport = new Report();
$stateobj1 = $stateobj->getAllStateFront();
$objreport1 = $objreport->showAllEnquiryByid($id);
$imge = explode(',',$objreport1['upload']);


$objquote = new Quote();
$getquote = $objquote->getAllQuotebyID($id);

if(isset($_POST['id']))
{
	
if(!empty($_POST['id']))
{
$prodobj->Update_Buying_Request_for_offer($_POST);
flashMsg("You have successfully Accept the Offer");
redirectUrl(CreateLink(array('supplier', 'mode'=>'details','id'=>$id)));
}}



?>



<section class="section">
<div class="center_main">


<div class="buying_request">

<table>
      
        
         <!--   <tr>
            <td>Buyer First Name</td>
             <td><?php echo $objreport1['name']; ?></td>
             </tr>
             <tr>
            <td>Buyer Last Name</td>
             <td><?php echo $objreport1['last_name']; ?></td>
             </tr>
             <tr>
            <td>Buyer Email Id</td>
             <td><?php echo $objreport1['email']; ?></td>
             </tr>-->
            
             <tr>
            <td>Company Name</td>
             <td><?php echo $objreport1['company_name']; ?></td>
             </tr>
            
              <tr>
            <td>Location</td>
             <td><?php echo $objreport1['location']; ?></td>
             </tr>
              <tr>
            <td>Post Code</td>
             <td><?php echo $objreport1['post_code']; ?></td>
             </tr>

              <tr>
            <td>Catalogue Category</td>
             <td><?php echo $objreport1['catalog_category']; ?></td>
             </tr>

<tr>
            <td>Catalogue Name</td>
             <td><?php echo $objreport1['catalog_name']; ?></td>
             </tr>
              <tr>
            <td>Description</td>
             <td><?php echo $objreport1['description']; ?></td>
             </tr>


<tr>
            <td>Upload File</td>
            <td>
            <?php $i=1;foreach($imge as $imagevalue){?>

             <a href="<?php echo PUBLICPATH."buying_request_file/".$imagevalue; ?>" target="_blank"><?php echo $imagevalue; ?> <?php echo $i++;?> | </a>
               <?php } ?>
             </td>
           
             </tr>
             


</table>
</div>
<div class="message">
<div class="buying_request">
<h2>View Clarification board</h2>
<table class="view_request_css">
 <thead>

            <tr>
                 <th scope="col">Id</th>
               <th scope="col">Seller Name</th>
             
             
                <th scope="col">View Details</th>
                 <th scope="col">Action</th>
                
            </tr>
            </thead>
            
                          <tbody>
                          <?php $i=1;
						   foreach($getquote as $getquote1 ) {
							  
							   ?>
                                <tr>
                    <td class="align-center"><?php echo $i++; ?></td>
                        <td class="align-center"><?php echo  $getquote1 ['name']; ?></td>
                         
                        
                        <td class="align-center">  <a href="<?php echo CreateLink(array('supplier','mode'=>'chatdetail','id'=>$objreport1['id'],'usid'=>$getquote1['user_id'])); ?>">View Details</a>        
                                                </td>
                                                <td> <form name="approve" action="#" method="post">
                                                 <input type="hidden" name="id" id="id" value="<?php echo $id;?>" /> 
                                                 <input type="hidden" name="seller_id" id="id" value="<?php echo  $getquote1 ['user_id']; ?>" /> 
                                                <input type="checkbox" name="approve" value="1" 
												<?php if($getquote1['user_id']==$objreport1['seller_id']) {echo "checked disabled";}?> onClick="submit();" /> Accept offer
                                                </form></td>
                
                    </tr>
                               
                <?php } ?>
            </tbody>
            
            
</table>
</div>

</div>


</div>
</section>
