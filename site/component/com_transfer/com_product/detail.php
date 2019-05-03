<?php
    Html::AddStylesheet("product/assests/base.css","component");
    Html::AddJavaScript("product/assests/jquery.js","component");
    Html::AddJavaScript("product/assests/jquery.jcarousel.min.js","component");
    Html::AddJavaScript("product/assests/jquery.pikachoose.min.js","component");
    $objProduct = new Product();
    $objCategory = new Category();

    $id = isset($_GET['id'])?$_GET['id']:'';
    $productInfo = $objProduct->CheckProduct($id);


    $breadcrumb = $objCategory->getBreadcumProduct($productInfo['category_id']);

    if(isset($_REQUEST['quote'])){

        if(isset($_SESSION['FRONTUSER']['usertype']) ) {

            if($_SESSION['FRONTUSER']['usertype'] == 2) {
                if(!empty($_REQUEST['quantity'])){

                    $quote = new Quote();

                    $quote->addToQuote($_REQUEST);

                    flashMsg('Success: You have added <span class="blue">'.$productInfo['name'].'</span> to your <a href="'.CreateLink(array('dashboard#tab3')).' " class="blue" >Quote Request</a>!');
                    redirectUrl( CreateLink(array('product','itemid'=>'detail&id='.$_GET['id'])));
                } else {
                    flashMsg('Error: Empty quantity allowed !','2');
                    redirectUrl( CreateLink(array('product','itemid'=>'detail&id='.$_GET['id'])));
                }
            } else {
                flashMsg('You have no permission to add this product! Please register as a Customer!','3');
                redirectUrl( CreateLink(array('product','itemid'=>'detail&id='.$_GET['id'])));
            }
        } else {
            flashMsg('Please <a href="'.CreateLink(array('signin')).' " class="blue" >login</a> or <a href="'.CreateLink(array('register')).' " class="blue" > Register</a> as a customer to add products  !','3');
            redirectUrl( CreateLink(array('signin')));
        }
    }
?>

<script language="javascript">
    jQuery(document).ready(
        function (){
            jQuery("#pikame").PikaChoose({transition:[0]} );
        });
</script>
<div class="main_mat">
<p><a href="<?php echo ITFPATH; ?>">Home</a> / <a href="<?php echo CreateLink(array('product')); ?>">Product</a> <?php echo $breadcrumb; ?> / <?php echo $productInfo['name']; ?></p>
</div>


<div class="product_lft">
    <?php include('category.php'); ?>
</div>


<div class="product_rgt">
    <div class="pro_detail_lft">123
        <?php if($productInfo["image"] && !empty($productInfo["image"])){ $images = explode(",",$productInfo["image"]); ?>
        <div class="pikachoose">
            <ul id="pikame" >
                <?php foreach($images as $image){?>
                <li><?php if(file_exists(PUBLICFILE."/products/".$image)){ ?>
                    <img src="<?php echo PUBLICPATH."/products/".$image; ?>"/>
                    <?php } else { ?>
                     <img src="<?php echo PUBLICPATH."/products/noImageProduct.jpg"; ?>"/>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } else { ?>
                <?php if(file_exists(PUBLICFILE."/products/".$productInfo["main_image"]) && !empty($productInfo['main_image'])){ ?>
                    <img src="<?php echo PUBLICPATH."/products/".$productInfo["main_image"]; ?>" width="300px" height="320px"/>
                <?php } else { ?>
                    <img src="<?php echo PUBLICPATH."/products/noImageProduct.jpg"; ?>" width="300px" height="320px" />
                <?php } ?>
        <?php } ?>
    </div>

    <div class="pro_detail_rgt">
    <h3><?php echo $productInfo['name']; ?></h3>
        <div class="qant">
        <form name="productform" id="productform" method="post" action="<?php echo CreateLink(array('product','itemid'=>'detail&id='.$_GET['id'])); ?>">
        <input type="hidden" name="id" value="<?php echo $productInfo['id']; ?>" >
        <label>Quantity: </label>
            <input type="text" name="quantity" value="1" size="2">
        <div class="clear"></div>
        </div>
        <div class="describe">
        <h4>Description</h4>
        <p><span>Info</span><br>
        <?php echo $productInfo['logn_desc']; ?> </p>
        <p><span>Specifications</span><br>
            <?php echo $productInfo['specification']; ?>
        </p>

        </div>
        <div class="info" id="info"><input name="quote" type="submit" value="Add to Quote Request"> </div>
        </form>
    </div>
</div>