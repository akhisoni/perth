<script type="text/javascript">

$(document).ready(function() {

	$("#itffrminput").validate({

	rules: {

			catname: "required",

            image:{accept:"jpg|png|gif|jpeg"}

		},

		messages: {

			catname: "Please enter zone name"

		}

	});

});

</script>

<?php

if(isset($_POST['id']))

{

	$userids=$_POST['id'];

	if(!empty($_POST['id']))

	{

		$categoryobj->admin_updateZone($_POST);

		flash("Zone is successfully Updated");

		redirectUrl("itfmain.php?itfpage=".$currentpagenames);

	}

	else

	{

		$categoryobj->admin_addZone($_POST);

		flash("Zone is successfully added");

		redirectUrl("itfmain.php?itfpage=".$currentpagenames);

	}

}



$ids=isset($_GET['id'])?$_GET['id']:'';

$ItfInfoData = $categoryobj->CheckZone($ids);

$categories = $categoryobj->showCategoriesList(0);

$userobj = new User();

$itfUserdata = $userobj->ShowAllSupplierAdmin();



//echo"<pre>"; print_r($categories); die;

?>



<div class="full_w">

    <!-- Page Heading -->

    <div class="h_title"><?php echo ($ids=="")?"Add New ":"Edit "; echo $pagetitle;?></div>

    <!-- Page Heading -->



    <form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>" />



        <div class="element">

            <label>Parent<span class="blue">(optional)</span></label>

            <select name="parent" class="err">

                <option value="0">-- Select Zone --</option>

                <?php foreach($categories as $key=>$cat) {?>

                    <option value="<?php echo $key ?>" <?php if($key == $ItfInfoData["parent"]){ echo"selected";} ?>><?php echo $cat; ?></option>

                <?php } ?>

            </select>

        </div>



        <div class="element">

            <label>Zone Name<span class="red">(required)</span></label>

            <input class="text" name="zonename" type="text"  id="catname" size="35" value="<?php echo isset($ItfInfoData['zonename'])?$ItfInfoData['zonename']:'' ?>" />

        </div>

  <div class="element">
        <label>Slug URL Name </label>
        <input class="text"  name="slug" type="text"  id="slug" size="35" value="<?php echo isset($ItfInfoData['slug'])?$ItfInfoData['slug']:'' ?>" />
    </div>

        <div class="element">

            <label>Zone Image</label>

            <input class="text" name="image" type="file"  id="image" size="35" />

            <?php if($ItfInfoData['image']){ ?>

                <div class="display"><img src="<?php echo PUBLICPATH."/categories/".$ItfInfoData['image']; ?>" height="40" width="40"/></div>

            <?php } ?>

        </div>
        
          <div class="element">
        <label>Zone Description</label>
        <textarea class="textarea" name="cat_desc" type="text"  id="cat_desc"><?php echo isset($ItfInfoData['cat_desc'])?$ItfInfoData['cat_desc']:'' ?></textarea>
    </div>

        
         <div class="element">
        <label>Title</label>
        <input class="text" name="pagetitle" type="text"  id="pagetitle" size="35" value="<?php echo isset($ItfInfoData['pagetitle'])?$ItfInfoData['pagetitle']:'' ?>" />
    </div>

        
         <div class="element">
        <label>Keyword</label>
        <input class="text" name="pagekeywords" type="text"  id="pagekeywords" size="35" value="<?php echo isset($ItfInfoData['pagekeywords'])?$ItfInfoData['pagekeywords']:'' ?>" />
    </div>

    <div class="element">
        <label>Meta tag (Meta Description)</label>
        <textarea class="textarea" name="pagemetatag" type="text"  id="pagemetatag"><?php echo isset($ItfInfoData['pagemetatag'])?$ItfInfoData['pagemetatag']:'' ?></textarea>
    </div>



<!--<div class="element">

        <label>Seller Name</label>

       <select name="seller_id" id="seller_id">

      <option value="">--Select Seller--</option>       

       <?php foreach($itfUserdata as $itfUser) {?>

       <option value="<?php echo $itfUser['id'];?>"<?php if($ItfInfoData["seller_id"] == $itfUser['id']){ echo"selected";} ?>><?php echo $itfUser['name'];?></option>

       <?php } ?>

       </select>

    </div>-->

        <!-- Form Buttons -->

        <div class="entry">

            <button type="submit">Submit</button>

            <button type="button" onclick="history.back()">Back</button>

        </div>

        <!-- End Form Buttons -->

    </form>

    <!-- End Form -->

</div>