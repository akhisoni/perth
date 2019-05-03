<?php
    Html::AddStylesheet("service/assests/category.css","component");
    Html::AddJavaScript("service/assests/jquery.min-1.9.js","component");
    Html::AddJavaScript("service/assests/jquery.accordionMenu.js","component");

    $objCategory = new ServiceCategory();
    $categoryinfo = $objCategory->getAllCategoryFront();

?>

<script>
		jQuery(function() {
			jQuery("#acdnmenu").accordionMenu();
		});
	</script>
<h3>Service Category</h3>
<div id="menu">
    <nav>
        <div id="acdnmenu" style="width:235px;height:auto;">

            <ul>

                <?php foreach ($categoryinfo as $category){ ?>
                    <li class='has-sub'>
                        <?php if(!$category['subcat']) { ?>
                            <a href="<?php echo CreateLink(array('service','itemid'=>'catdetail','id'=>$category['id'])); ?>">
                        <?php } ?>
                          <?php echo $category['catname']; ?> </a>

                            <?php if($category['subcat']) { ?>
                                <ul>
                                    <?php foreach($category['subcat'] as $subcat) { ?>
                                        <li class='has-sub'>
                                                <?php if(!$subcat['subcat']) { ?>
                                                <a href="<?php echo CreateLink(array('service','itemid'=>'catdetail','id'=>$subcat['id'])); ?>">
                                                <?php } ?>
                                                <?php echo $subcat['catname']; ?> </a>

                                                <?php if($subcat['subcat']) { ?>
                                                    <ul>
                                                        <?php foreach($subcat['subcat'] as $subsubcat) { ?>
                                                            <li>
                                                                <?php if(!$subsubcat['subcat']) { ?>
                                                                <a href="<?php echo CreateLink(array('service','itemid'=>'catdetail','id'=>$subsubcat['id'])); ?>">
                                                                <?php } ?>

                                                                <?php echo $subsubcat['catname']; ?></a>

                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>

                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>