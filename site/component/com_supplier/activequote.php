<div class="active_quote" id="quote_active">
        <?php if(count($activeQuotes) > 0 ) { ?>
            <ul>
                <li>
                    <div class="pro_name_lft">
                        <p><b>Quote Title</b></p>
                    </div>
                    <div class="pro_name_second">
                        <p><b>Quote Created By </b></p>
                    </div>
                    <div class="pro_name_third">
                        <p><b>Status</b></p>
                    </div>
                    <div class="pro_name_rgt">
                        <p><b>Delivery Location</b></p>
                    </div>
                    <div class="clear"></div>
                </li>

                <?php foreach($activeQuotes as $quotes) { ?>
                    <li>
                        <div class="pro_name_lft">
                            <a href="#itf" title="click for details" onclick="showActiveQuotes(<?php echo $quotes['id']; ?>)">
                                <p><span><?php echo $quotes['quote_name']; ?></span></p>
                                <p><?php echo $quotes['quote_desc']; ?></p>
                            </a>
                        </div>
                        <div class="pro_name_second">
                            <p>
                                    <span><?php echo $quotes['customer']; ?></span>
                            </p>
                        </div>
                        <div class="pro_name_third">
                            <p><span><?php echo $quote->getQuoteStatus($quotes['bid_closed']); ?></span></p>
                        </div>
                        <div class="pro_name_rgt">
                            <p><span><?php echo $quotes['location_name']; ?></span></p>
                        </div>
                        <div class="clear"></div>
                    </li>
                <?php } ?>

            </ul>
        <?php } else { ?>
            <p style="text-align: center; margin-top: 50px;">No Active Quotes Available !</p>
        <?php } ?>
    </div>
    <div id="active_quotes"></div>