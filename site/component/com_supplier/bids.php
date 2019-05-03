<div class="active_quote" id="my_bid">
        <h3>My Bids</h3>

        <?php if(count($bids) >0 ) { ?>
        <ul>

            <li>
                <div class="bid_lft">
                    <p><b>Quote Summary</b></p>
                </div>
                <div class="bid_second">
                    <p><b>Bid Amount</b></p>
                </div>
                <div class="bid_third">
                    <p><b>Bid Details</b></p>
                </div>
                <div class="bid_forth">
                    <p><b>Status</b></p>
                </div>
                <div class="bid_rgt">
                    <p><b>Discard</b></p>
                </div>
                <div class="clear"></div>
            </li>
            <?php foreach($bids as $bid) {if($bid['bid_closed']!='2'){ ?>
            <li>
                <div class="bid_lft">
                    <a href="#itf" title="click for detail" onclick="showQuoteDetails(<?php echo $bid['quote_id']; ?>)">
                    <p><span><?php echo $bid['quote_name']; ?></span><br>
                        <span class="small-text"><?php echo $bid['quote_desc']; ?></span></p>
<!--                    <span class="small-text"><?php echo WordLimit($bid['quote_desc']); ?></span></p>-->
                     </a>
                </div>
                <div class="bid_second">
                    <p><span><?php echo Currency($bid['bid_amount']); ?></span></p>
                </div>
                <div class="bid_third">
                    <p><span><?php echo $bid['bid_desc']; ?></span></p>
<!--                    <p><span><?php echo WordLimit($bid['bid_desc']); ?></span></p>-->
                </div>
                <div class="bid_forth">
                    <p><span><?php echo $quote->getBidStatus($bid['status']); ?></span></p>
                </div>
                <div class="bid_rgt">
                    <p><span><a href="#itf" onclick="discardBid(<?php echo $bid['id']; ?>)"><img alt="close" src="<?php echo TemplateUrl(); ?>/images/close_btn.png"></a> </span></p>
                </div>
                <div class="clear"></div>
            </li>
           <?php } } ?>
        </ul>
        <?php  } else { ?>
                <p style="text-align: center">No Bids Available !</p>
           <?php } ?>
    </div>
    <!--<div id="bid_quote_detail"></div>-->