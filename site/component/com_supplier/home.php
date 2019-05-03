<div class="cont_info">
        <div class="summary">
            <div class="summary_lft">
                <div class="summary_lft_cont">
                    <p>Seller Id:<span> <?php echo $userinfo['registration_id'];?></span></p>
                    <p>Member Since:<span> <?php echo date('d M Y',$userinfo['created_date']); ?></span></p><br>
                    
                </div>
            </div>
            <div class="summary_rgt">
                <div class="map">
                    <?php
                    if(isset($userinfo['address']) && !empty($userinfo['address'])){
                        $myaddress = urlencode($userinfo['address']);
                        //here is the google api url
                        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$myaddress&sensor=false";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $getmap = curl_exec($ch);
                        curl_close($ch);

                        $googlemap = json_decode($getmap);
                        //get the latitute, longitude from the json result by doing a for loop
                        foreach($googlemap->results as $res){
                            $address = $res->geometry;
                            $latlng = $address->location;
                            $formattedaddress = $res->formatted_address;

                            ?>
                            <iframe class="map" width="447" height="257" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $myaddress;?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo urlencode($formattedaddress);?>&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                        <?php
                            break;
                        }
                    }else {?>
                        <img src="<?php echo IMAGEPATH.'map-not-available_lg.gif';?>" width="447" height="257" >

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>