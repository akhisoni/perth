<?php
$getcat= $objcategory->getAllActiveCat();
$getloc = $objlocation->getAllStateFront();

?>


<div class="center-content">
<div class="contianer">


<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li>Advance Search</a></li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Advance Search</h1>
  </div>
  
<div class="inner_content">
<div class="form adv-search">
    <form id="advanced-search-form" action="<?php echo CreateLink(array("advance_search_result")); ?>" method="post" nctype="multipart/form-data">        
    <input name="mode" value="search" type="hidden">
        <div class="row">
            <label for="txt-keyword">Search for</label>
            <input class="text-1" name="name" id="name" value="" type="text">           
             <div class="check">
              
                <input name="name_check" id="name_check" value="1" type="checkbox"><label>exact phrase</label>
            </div>
        </div>
        
        
        <div class="row">
            <label for="txt-adid">Ad ID</label>
            <input class="text-2" name="id" id="id" type="text">        
            </div>
        
        
        <div class="row">
            <label for="cate">Category</label>
            <select name="cat_id" id="cat_id">
            
            
<option value="">All</option>
<?php foreach($getcat as $getcats) {?>
<option value="<?php echo $getcats['id']; ?>"><?php echo $getcats['catname']; ?></option>
<?php } ?>
</select>        </div>


        <div class="row">
            <label for="loca">Location</label>
            <select class="select-1" name="location" id="location">
<option value="">All</option>

<?php foreach($getloc as $getlocs){?>
<option value="<?php echo $getlocs['id']; ?>"><?php echo $getlocs['name']; ?></option>
<?php } ?>

</select>        </div>


        <div class="row">
            <label>Zip Code</label>
            <input class="text-3" name="zip" id="zip" maxlength="10" type="text">        </div>
            
            
        <div class="row">
            <label>Price</label>
            <input class="text-4" name="minprice" id="minprice" type="text">  <label class="type">to</label>
            <input class="text-4" name="maxprice" id="maxprice" type="text">        </div>
            
            
        <div class="row">
            <label>With Photo</label>
            <input id="image" value="0" name="image" type="hidden">
            <input name="image" id="image" value="1" type="checkbox"></div>
            
            
        <div class="row buttons">
          <input class="btn" value="Search" style="margin-left: 0;" type="submit">
        </div>
    </form></div>
</div>
</div>
</div>






</div>
</div>