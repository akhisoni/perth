<?php
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);

$categories = $categoryObj->getCategories();
$ItfInfoData = $categoryObj->CheckCategory($ids);
$categories = $categoryObj->showCategoriesList(0);
if(isset($_POST['submit'])){
	if(isset($_POST['catname'])){
	
	if(!empty($_POST['id']))
	{ 
	$categoryObj->admin_updateCategory($_POST);
	flashMsg("Category is successfully Updated");
	  redirectUrl(CreateLink(array("supplier&mode=listcategory")));
	}
	else
	{
	
	
	$categoryObj->admin_addCategory($_POST);
	flashMsg("Category is successfully added");
	  redirectUrl(CreateLink(array("supplier&mode=category")));
	}
	}
}

$ids=isset($_GET['id'])?$_GET['id']:'';
$ItfInfoData = $categoryObj->CheckCategorySeller($ids);
?>


<div class="my_categori">
        <h3>Add Categories</h3>
        <form action="" method="post" id="info" class="catadd" name="frmcategory" enctype="multipart/form-data">
             <input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />
           <input type="hidden" name="seller_id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
        <div class="sec">
            <label>Parent<span class="blue"> (optional)&nbsp;</span></label>
            <select name="parent" class="sect">
                <option value="0">-- Select Category --</option>
                <?php foreach($categories as $key=>$cat) {?>
                    <option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["parent"]){ echo"selected";} ?>><?php echo $cat; ?></option>
                <?php } ?>
            </select>
             <div class="clear"></div>
        </div>

        <div class="sec">
            <label>Category Name <span class="required">*</span></label>
            <input class="text" name="catname" type="text"  id="catname" size="35" value="<?php echo isset($ItfInfoData['catname'])?$ItfInfoData['catname']:'' ?>" />
 <div class="clear"></div>
        </div>
 
        <div class="sec">
        <?php if($ItfInfoData['image']){ ?>
                <div class="display"  style="text-align:center"><img src="<?php echo PUBLICPATH."/categories/".$ItfInfoData['image']; ?>" height="40" width="40"/></div>
            <?php } ?>
            <label>Category Image </label>
            <input class="text" name="image" type="file"  id="image" size="35" />
            
            <div class="clear"></div>
        </div>
 
        <!-- Form Buttons -->
        <div class="sec">
        <label>&nbsp;</label>
            <input type="submit" name="submit" value="submit" />
            <div class="clear"></div>
        </div>
            <!-- End Form Buttons -->
    </form>
       
    </div>