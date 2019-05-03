
<div class="cont_info">
        <h3>Contact Information</h3>
        <form id="info" name="profile"  class="my_pro" method="post" action="<?php echo CreateLink(array('supplier')); ?> " enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($userinfo['user_id'])?$userinfo['user_id']:''; ?>">
            <div class="sec">
                <label>First Name <span class="required">*</span></label>
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
                <input name="emailid" type="text"  value="<?php echo isset($userinfo['email'])?$userinfo['email']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Company Name <span class="required">*</span></label>
                <input name="company_name" type="text"  value="<?php echo isset($userinfo['company_name'])?$userinfo['company_name']:''; ?>">
                <div class="clear"></div>
            </div>
            <div class="sec">
                <label>Change Password - to change the current password.</label>
                <input name="change_password" type="password" value="">
                <div class="clear"></div>
            </div>
            <!--<div class="sec">
                <label>Location<span class="required"> *</span></label>
                     <select class="sect_category" name="serviceArea[]" id="servicecategory" multiple>
            <?php foreach($areas as $area){  $city_ids = explode(",",$userinfo['city_id']);?>

                         <option value="<?php echo $area['id']; ?>" <?php if(in_array($area['id'],$city_ids)){ echo "selected"; } ?>><?php echo $area['name']; ?></option>
                       
                         
                
            <?php } ?>
                     </select>&nbsp;<a  style="cursor:pointer;" onClick="selectAllLocation()">Select All</a>&nbsp;|&nbsp;<a style="cursor:pointer;" onClick="unselectAllLocation()">UnSelect All</a>
                <div class="clear"></div>
            </div>-->

            <?php /*?><div class="sec">
                <label>Service Category <span class="required">*</span></label>
                <select class="sect_category" name="serviceGroup[]" id="servicecategory" multiple>
                    <?php foreach($services as $cat){  $cat_ids = explode(",",$userinfo['service_category']);?>
                        <?php if(count($cat['subcat']) > 0){ ?>
                            <optgroup label="<?php echo $cat['catname'] ?>" style="padding-top: 10px;">
                                <?php foreach($cat['subcat'] as $subcat){ ?>
                                    <?php if(count($subcat['subcat']) > 0){ ?>
                                        <optgroup label="<?php echo $subcat['catname'] ?>" style="padding-left: 10px;">
                                            <?php foreach($subcat['subcat'] as $subsubcat){ ?>
                                                <option value="<?php echo $subsubcat['id'] ?>" <?php if(in_array($subsubcat['id'],$cat_ids)){ echo "selected"; } ?>><?php echo $subsubcat['catname'] ?></option>
                                            <?php } ?>
                                        </optgroup>

                                    <?php } else { ?>
                                        <option value="<?php echo $subcat['id'] ?>" <?php if(in_array($subcat['id'],$cat_ids)){ echo "selected"; } ?>><?php echo $subcat['catname'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </optgroup>

                        <?php } else { ?>
                            <option value="<?php echo $cat['id'] ?>" <?php if(in_array($cat['id'],$cat_ids)){ echo "selected"; } ?> ><?php echo $cat['catname'] ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>
            </div><?php */?>
            
            <div class=" sec">
                <label>Country <span class="required">*</span></label>  <?php if(!isset($userinfo['country_code'])){$userinfo['country_code']='AU';}?>
                <select class="sect" name="country_code">
                    <?php foreach($countries as $country){ ?>
                        <option value="<?php echo $country['country_code'];?>" <?php if($userinfo['country_code'] == $country['country_code']){ echo"selected"; } ?>>
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
                <label>Postal Code</label>
                <input name="postal_code" type="text" value="<?php echo isset($userinfo['postal_code'])?$userinfo['postal_code']:''; ?>">
                <div class="clear"></div>
            </div>
            
            <div class="sec">
                <label>Edit Image</label>
                <img src="<?php echo PUBLICPATH."/profile/"; ?><?php if($userinfo['profile_image']){ echo $userinfo['profile_image'];} else { echo 'no_image.jpg'; }; ?>" class="edit_mg" height="129px" width="120px">
                <div class="upld">
                    <p><input type="file" name="image" value="Upload"> </p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

            <div class="sec">
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="update">
                <div class="clear"></div>
            </div>
        </form>			