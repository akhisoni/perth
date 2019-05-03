<?php 
$prodobj = new Product();
$stateobj = new State();
$objrep = new Report();
$stateobj1 = $stateobj->getAllStateFront();
$objreport = $objrep->showAllEnquiryFront();
$categoryobj = new Category();
$categories = $categoryobj->getAllCategoryFront(0);
$perpage ='30';
$urlpath = CreateLink(array($currentpage))."&";

$sortby = $_REQUEST['catalog_category'];
$lis = $_REQUEST['location'];

if(isset($_REQUEST['submit']) and !empty($_REQUEST['submit']))
{
	//echo"<pre>";print_r($_REQUEST);die;
$objreport = $objrep->showAllEnquirySearch($_REQUEST['catalog_category'],$_REQUEST['location']);
}
else if(isset($_REQUEST['search']) and !empty($_REQUEST['search']))
{
$objreport = $objrep->showAllEnquiryTextSearch($_REQUEST['search_data']);

}else{
	$objreport = $objrep->showAllEnquiryFront();
	}
	
$pagingobj = new ITFPagination($urlpath,$perpage);
$objreport1 = $pagingobj->setPaginateData($objreport);

?>
<script>function jsFunction(value)
{
    
}</script>

<section class="section">
<div class="center_main">
<div class="home">Home > <span>View Buying Requests</span></div>
<?php include('category.php'); ?>

<div class="main-about">

<div class="about-one">
<h1>View Buying Requests </h1><img src="<?php echo TemplateUrl();?>image/line-sm.png"/> 
</div>
<div class="sort_by">
<div class="sort_by_down" style="width:100%;">Sort By:
               <form id="itffrmsearch" name="itffrmsearch" method="get" action="">
               <input type="hidden" name="itfpage" value="<?php echo $currentpage; ?>" />
               <select name="catalog_category" style="width:auto;">
               <option value="">Select Category</option>
            <?php foreach($categories as $cat) {?>
                <option value="<?php echo $cat['catname']; ?>" <?php if($sortby == $cat['catname']){ echo 'selected';}?>><?php echo $cat['catname']; ?></option>
            <?php } ?>
               </select>
                <select name="location" style="width:auto;">
               <option value="">Select Location</option>
                <?php foreach($stateobj1 as $stateobj2){
					$sta= $stateobj2['name'];?>
<option value="<?php echo $stateobj2['name'];?>" <?php if($lis == $sta){ echo 'selected';}?>><?php echo $stateobj2['name'];?></option>
<?php } ?>
               </select>
               <input type="submit" name="submit" value="submit" />
               </form>&nbsp;OR &nbsp;Search By Keywords:
<form id="itffrmsearch" name="itffrmsearch" method="get" action="">
 <input type="hidden" name="itfpage" value="<?php echo $currentpage; ?>" />
             <input type="text" name="search_data" placeholder="Enter keyword here..." />
               <input type="submit" name="search" value="submit" />
               </form>         
             
</div>

</div>

<div class="Plucka_online">
<div class="buying_request"><br />
<table class="view_request_css">
 <thead>

            <tr>
                 <th scope="col">Id</th>
                 <th scope="col">Date</th>
        <!--       <th scope="col">Buyer Name</th>-->
                <th scope="col" style="width:300px;">Category </th>
                 <th scope="col" style="width:200px;">Location</th>
                    <th scope="col">Post Code</th>
               
                 
                  <th scope="col">Action</th>
                
            </tr>
            </thead>
            
            <?php 
			$i=1;
			foreach($objreport1 as $objreport2){
				
				?>
              <tbody>
                                <tr>
                    <td class="align-center"><?php echo $i++;?></td>
                     <td><?php echo date("d-m-Y", strtotime($objreport2['date_added']));?></td>
                       <!-- <td class="align-center"><?php echo $objreport2['name'];?></td>-->
                         <td class="align-center buying_width"><?php echo $objreport2['catalog_category'];?></td>
                           <td class="align-center"><?php echo $objreport2['location'];?></td>
                             <td class="align-center"><?php echo $objreport2['post_code'];?></td>
                            
                        <td class="align-center">
                        <?php if($_SESSION['FRONTUSER']['usertype'] == 3){
 ?>
                        <a href="<?php echo CreateLink(array('view_request','itemid'=>'view_detail','id'=>$objreport2['id'])); ?>">
                        View Buying Request</a>
						
						<?php } if($_SESSION['FRONTUSER']['usertype'] == 2){?>
                         <a href="<?php echo CreateLink(array("customer","msg"=>'view_seller')); ?>">
                        View Buying Request</a>
                        <?php }  if($_SESSION['FRONTUSER']['usertype'] == ''){?>
                         <a href="<?php echo CreateLink(array("signin","msg"=>'view')); ?>">
                        View Buying Request</a>
                        <?php }if($_SESSION['FRONTUSER']['usertype'] == '4'){?>
                        <a href="<?php echo CreateLink(array('view_request','itemid'=>'view_detail','id'=>$objreport2['id'])); ?>">
                        View Buying Request</a>
						<?php } ?>
                        </td>
                        
                
                    </tr>
                    <?php } ?>
                 
                
            </tbody>
            
            
</table>
<div class="page">
<?php echo $pagingobj->Pages(); ?>

</div>
</div>
</div>
</div>
</div>
</section>
