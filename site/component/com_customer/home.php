<div class="cont_info">
        <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyDI6TNXqSv2QJ8W9J8fmMzTp0qd9U2q6WQ&sensor=false" type="text/javascript"></script>
        <div class="summary">
            <div class="summary_lft">
                <div class="summary_lft_cont">
                    <p>Buyer Id:<span> <?php echo $userinfo['registration_id'];?></span></p>
                    <p>Member Since:<span> <?php echo date('d M Y',$userinfo['created_date']); ?></span></p><br>
                   <?php /*?> <p><b>Summary of quote requested:</b></p>
                    <p>Total quote requested:<span> <?php echo $quote->getTotalQuoteByUser($_SESSION['FRONTUSER']['id']); ?></span></p>
                    <p>Total quotes fulfilled:<span> <?php echo count($closedQuotes); ?></span></p><?php */?>
                </div>
            </div>
            <div class="summary_rgt">
                <div class="map">
                    <?php
                       if(!empty($userinfo['address']) and !empty($userinfo['country_name'])){
                        $myaddress = urlencode($userinfo['address'].' '.$userinfo['country_name']);
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
                    } else {?>
                        <img src="<?php echo SITEURL.'images/map-not-available_lg.gif';?>" width="447" height="257" >

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>