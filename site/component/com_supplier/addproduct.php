<?php 
ini_set('max_execution_time', 1000000);
$proobj = new Product();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$categoryObj = new Category();
$categories = $categoryObj->getCategories();
$categories = $categoryObj->showCategoriesList(0);

   if(!empty($_POST['name'])){
		if(!empty($_POST['id']))
	{
		$proobj->admin_update($_POST);
		flash("Catalogue is succesfully updated");
	    redirectUrl(CreateLink(array("supplier&mode=listproduct")));
	}
	else
	{
		$proobj->admin_add($_POST);
		flashmsg("Catalogue is succesfully added");
	    redirectUrl(CreateLink(array("supplier&mode=addproduct")));
	}}
	
$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $proobj ->CheckProductSeller($ids);

?>

<div class="detail_buying_rquest">
<h3>Add Catalogue</h3>
<div class="money product">
<form id="info"  class="addproduct" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="seller_id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
<input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />
<div class="sec">
<label>Select Category <span class="required">*</span></span></label>
<select name="category_id" class="sect">
    <option value="">-- Select Category --</option>
    <?php foreach($categories as $key=>$cat) {?>
<option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["category_id"]){ echo"selected";} ?>><?php echo $cat; ?></option>
    <?php } ?>
</select>
 <div class="clear"></div>
</div>

    <div class="sec">
    <label>Catalogue Code <span class="required">*</span> </label>
    <input type="text" name="code" value="<?php echo isset($ItfInfoData['code'])?$ItfInfoData['code']:'' ?>">
    <div class="clear"></div>
</div>
<div class="sec">
    <label>Catalogue Name <span class="required">*</span> </label>
    <input type="text" name="name" value="<?php echo isset($ItfInfoData['name'])?$ItfInfoData['name']:'' ?>">
    <div class="clear"></div>
</div>
<div class="sec">
  <?php if($ItfInfoData['main_image']){ ?>    
        <div class="display" style="text-align:center"><img src="<?php echo PUBLICPATH."/products/".$ItfInfoData['main_image']; ?>" height="40" width="40"/></div>    
        <?php } ?>
    <label>Catalogue Image <span class="required">*</span></label>
    <input type="file" name="main_image" value="">
    <div class="clear"></div>
</div>
<div class="sec">
    <label>Catalogue Pdf <span class="required">*</span></label>
    <input type="file" name="pdf_name" value=""> (Maximum size 15 MB)
    <div class="clear"></div>
</div>
<div class="sec">
    <label>Description<span class="required">*</span></label>
    <textarea name="logn_desc"><?php echo isset($ItfInfoData['logn_desc'])?$ItfInfoData['logn_desc']:'' ?></textarea>
    <div class="clear"></div>
</div>

<!-- <div class="sec">
    <label>Specification <span class="required">*</span></label>
    <textarea name="specification"><?php echo isset($ItfInfoData['specification'])?$ItfInfoData['specification']:'' ?></textarea>
    <div class="clear"></div>
</div>-->


<div class="sec">
    <label>&nbsp;</label>
    <input type="submit" name="submit" value="Submit">
    <div class="clear"></div>
</div>
</form>
</div>
</div>