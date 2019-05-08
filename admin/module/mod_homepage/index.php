<?php
$userobj = new Site();

$currentpagenames = isset( $_GET[ 'itfpage' ] ) ? $_GET[ 'itfpage' ] : '';
$pagetitle = "Home Page Sections";
$ItfInfoData = $userobj->getHomePageDataSection( $_SESSION[ 'LoginInfo' ][ 'USERID' ] );
include( BASEPATHS . "/fckeditor/fckeditor.php" );
?>


<script type="text/javascript">
    $( document ).ready( function () {

        var Validator = jQuery( '#itffrminput' ).validate( {
            rules: {

                name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true
                },

            },
            messages: {

                name: "Please enter first name.",
                last_name: "Please enter last name.",
                email: "Please enter valid email id.",

            }
        } );
    } );
</script>
<?php
if ( isset( $_POST[ 'id' ] ) ) {
    if ( !empty( $_POST[ 'id' ] ) ) {
        $userobj->Home_Page_Update_Section( $_POST );
        flash( "Home Page Sections is successfully updated" );
        redirectUrl( "itfmain.php?itfpage=" . $currentpagenames );
    }
}
?>
<div class="full_w">
    <!-- Page Head -->
    <div class="h_title">
        <?php echo $pagetitle;?>
    </div>

    <form action="" method="post" name="itffrminput" id="itffrminput" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo isset($ItfInfoData['id'])?$ItfInfoData['id']:'' ?>"/>
        <h3>Below Slider Section </h3>
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Title <span class="red">(required)</span></label>
            <input class="text" name="b_title" type="text" id="b_title" size="35" value="<?php echo isset($ItfInfoData['b_title'])?$ItfInfoData['b_title']:'' ?>" required="required"/>
        </div>

        <div class="element">
            <span class="req">&nbsp;</span>
            <label> Description <span class="red">(required)</span></label>
            <textarea class="textarea" name="b_desc" type="text" id="b_desc" required><?php echo isset($ItfInfoData['b_desc'])?$ItfInfoData['b_desc']:'' ?></textarea>

        </div>

        <div class="element">
            
            <label>Background Banner Image <span class="req">*</span></label>

            <div id="FileUpload">
                <input type="file" size="24" id="b_image" name="b_image" class="BrowserHidden" onchange="getElementById('tmp_bannerimage').value = getElementById('b_image').value;" <?php if($ItfInfoData['b_image']) { echo ""; }else { echo "required";} ?>/>
                <div id="BrowserVisible"><input type="hidden" id="tmp_bannerimage" class="FileField"/>
                </div>
            </div>

            <?php if($ItfInfoData['b_image']) {
    ?><A href="<?php echo PUBLICPATH."home_about_banner/".$ItfInfoData['b_image']; ?>" download>
     <img src="<?php echo PUBLICPATH."home_about_banner/".$ItfInfoData['b_image']; ?>" width="48" height="48"  /></A>
    <?php
}?>
        </div>


        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Button URL</label>
            <input class="text" name="b_url" type="text" id="b_url" size="35" value="<?php echo isset($ItfInfoData['b_url'])?$ItfInfoData['b_url']:'' ?>" />
        </div>

        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Button Label Name</label>
            <input class="text" name="b_button" type="text" id="b_button" size="35" value="<?php echo isset($ItfInfoData['b_button'])?$ItfInfoData['b_button']:'' ?>"/>
        </div>

        
        <h3>Home Page Announcement Section</h3>
         <div class="element">
            <span class="req">&nbsp;</span>
            <label>Announcement </label>
            <input class="text" name="b_marquee" type="text" id="b_marquee" size="35" value="<?php echo isset($ItfInfoData['b_marquee'])?$ItfInfoData['b_marquee']:'' ?>"/>
        </div>
        <h3>Footer About Section</h3>  
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Footer About Title <span class="red">(required)</span></label>
            <input class="text" name="footer_about_title" type="text" id="footer_about_title" size="35" value="<?php echo isset($ItfInfoData['footer_about_title'])?$ItfInfoData['footer_about_title']:'' ?>" required />
        </div>
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label> Footer About Description <span class="red">(required)</span></label>
            <textarea class="textarea" name="footer_about_desc" type="text" id="footer_about_desc" required><?php echo isset($ItfInfoData['footer_about_desc'])?$ItfInfoData['footer_about_desc']:'' ?></textarea>

        </div>
        
         <h3>Footer Contact Us Section</h3>
        
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Contact No</label>
            <input class="text" name="footer_cont" type="text" id="footer_cont" size="35" value="<?php echo isset($ItfInfoData['footer_cont'])?$ItfInfoData['footer_cont']:'' ?>"  />
        </div>
        
        
          <div class="element">
            <span class="req">&nbsp;</span>
            <label>Contact Address</label>
            <input class="text" name="footer_add" type="text" id="footer_add" size="35" value="<?php echo isset($ItfInfoData['footer_add'])?$ItfInfoData['footer_add']:'' ?>"  />
        </div>
        
        
          <div class="element">
            <span class="req">&nbsp;</span>
            <label>Contact Address2</label>
            <input class="text" name="footer_add2" type="text" id="footer_add2" size="35" value="<?php echo isset($ItfInfoData['footer_add2'])?$ItfInfoData['footer_add2']:'' ?>" />
        </div>
        
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Contact Email Id</label>
            <input class="text" name="footer_email" type="text" id="footer_email" size="35" value="<?php echo isset($ItfInfoData['footer_email'])?$ItfInfoData['footer_email']:'' ?>" />
        </div>
        
         <div class="element">
            <span class="req">&nbsp;</span>
            <label>Facebook URL</label>
            <input class="text" name="footer_fb" type="text" id="footer_fb" size="35" value="<?php echo isset($ItfInfoData['footer_fb'])?$ItfInfoData['footer_fb']:'' ?>" />
        </div>
        
         <div class="element">
            <span class="req">&nbsp;</span>
            <label>Twitter URL</label>
            <input class="text" name="footer_twt" type="text" id="footer_twt" size="35" value="<?php echo isset($ItfInfoData['footer_twt'])?$ItfInfoData['footer_twt']:'' ?>" />
        </div>
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>linkedin URL</label>
            <input class="text" name="footer_link" type="text" id="footer_link" size="35" value="<?php echo isset($ItfInfoData['footer_link'])?$ItfInfoData['footer_link']:'' ?>" />
        </div>
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Instagram URL</label>
            <input class="text" name="footer_insta" type="text" id="footer_insta" size="35" value="<?php echo isset($ItfInfoData['footer_insta'])?$ItfInfoData['footer_insta']:'' ?>" />
        </div>
        
        <div class="element">
            <span class="req">&nbsp;</span>
            <label>Youtube URL</label>
            <input class="text" name="footer_youtube" type="text" id="footer_youtube" size="35" value="<?php echo isset($ItfInfoData['footer_youtube'])?$ItfInfoData['footer_youtube']:'' ?>" />
        </div>
        <!-- Form Buttons -->
        <div class="entry">
            <button type="submit">Submit</button>
            <button type="button" onclick="history.back()">Back</button>
        </div>
        <!-- End Form Buttons -->
    </form>
    <!-- End Form -->
</div>

<style>
    h3 { color: #E14848; font-size: 18px; font-weight: bold;}
</style>