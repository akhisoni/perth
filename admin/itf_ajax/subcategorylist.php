<?php
require('../../itfconfig.php');
$catid=$_REQUEST['category'];
//echo $catid;
$objcategory =new Category(); 
$categorylist=$objcategory->getAllActiveSubCat($catid);
//print_r($categorylist);

$ids=isset($_GET['id'])?$_GET['id']:'';
$propertyobj =new Product(); 
$InfoData = $propertyobj->CheckProduct($ids);
if(count($categorylist)>0)
{
?>


<select name="subcat_id" id="role"  class="field size1">
<option value="">Select Subcategory</option>
<?php foreach ($categorylist as $category): ?>
<option value="<?php echo $category['id'];?>" <?php echo $category['id']==$InfoData['subcat_id']?'Selected':'';?>><?php echo $category['catname']; ?></option>
<?php endforeach; ?>
</select>

<?php
}
else
{
?>


<select id="role" name="role">
<option value="">--No sub category found--</option>
</select>

<?php
}
?>