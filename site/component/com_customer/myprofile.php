<div class="cont_info">
     
        <form id="info" name="profile" method="post" action="<?php echo CreateLink(array('customer')); ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
            <div class="sec">
                <label>First Name <span class="required">*</span> </label>
                <input name="name" type="text" value="<?php echo isset($userinfo['name'])?$userinfo['name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Last Name <span class="required">*</span></label>
                <input name="last_name" type="text" value="<?php echo isset($userinfo['last_name'])?$userinfo['last_name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Email ID <span class="required">*</span></label>
                <input name="emailid" type="text" value="<?php echo isset($userinfo['email'])?$userinfo['email']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Change Password - to change the current password.</label>
                <input name="change_password" type="password" value="">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Country <span class="required">*</span></label>
                <?php //if(isset($userinfo['country_code'])){$userinfo['country_code']='AU';}?>
                <select class="sect" name="country_code">
                    <?php foreach($countries as $country){ ?>
                        <option value="<?php echo $country['country_code'];?>" <?php if($userinfo['country_code']==$country['country_code']){ echo"selected"; } ?>>
                            <?php echo $country['country_name'];?> (<?php echo $country['country_code'];?>)
                        </option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>


            <div class="sec">
                <label>Address <span class="required">*</span></label>
                <textarea name="address"><?php echo isset($userinfo['address'])?$userinfo['address']:''; ?></textarea>
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Mobile / Landline No.</label>
                <input name="email_phone" type="text" value="<?php echo isset($userinfo['email_phone'])?$userinfo['email_phone']:''; ?>">
                <div class="clear"></div>
            </div>
            
            <div class="sec">
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="update">
                <div class="clear"></div>
            </div>
        </form>			<?php /*?>	<?php 		   $reviews = $quote->reviews($userinfo['user_id']);		      ?>		<div class="active_quote close_quote">		 <label>Reviews</label>        <?php if(count($reviews) >0 ){ ?>        <ul>            <li>                <div class="pro_name2_mid">                    <p><b>Supplier Review</b></p>                </div>                <div class="clear"></div>            </li>            <?php foreach($reviews as $rev) {   ?>                <li>                    <div class="pro_name2_lft">                        <p><span><?php echo $rev['review_text']; ?></span></p>                    </div>					                     <div class="clear"></div>                </li>            <?php }  ?>        </ul>        <?php } else { ?>            <p style="text-align: center; margin-top: 50px;">No Review available ! </p>        <?php } ?>    </div><?php */?>
    </div>