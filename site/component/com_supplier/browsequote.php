<div class="active_quote" id="quotelist">
        <h3>Browse Quotes</h3>
        <?php if(count($enquiries) > 0) { ?>
        <ul>
            <li>
                <div class="pro_name_lft" style='width:180px;'>
                    <p><b>Quote by person</b></p>
                </div>                 <div class="pro_name_lft" style='width:211px;'>                    <p><b>Quote Title</b></p>                </div>
                <div class="pro_name_second">
                    <p><b>Bids</b></p>
                </div>
                <div class="pro_name_third">
                    <p><b>Started</b></p>
                </div>
                <div class="pro_name_rgt">
                    <p><b>Ends In</b></p>
                </div>
                <div class="clear"></div>
            </li>
            <?php foreach($enquiries as $enquiry) { ?>

                <?php if($enquiry['endTime'] > 0 ) { ?>
                <li>
                    <div class="pro_name_lft" style='width:180px;'>
                        <a href="#itf" title="click for detail" onclick="qotecustomerdetail(<?php echo $enquiry['user_id']; ?>)">
                        <p><span><?php $datas = $quote->username($enquiry['user_id']); echo $datas['registration_id']; ?></span></p>                        </a>
                    </div>					<div class="pro_name_lft" style='width:211px;'>                        <a href="#itf" title="click for bid" onclick="showdetails(<?php echo $enquiry['id']; ?>)">                        <p><span><?php echo $enquiry['quote_name']; ?></span></p>                        <p><?php echo $enquiry['quote_desc']; ?></p>                        </a>                    </div>
                    <div class="pro_name_second">
                        <p><a href="#itf" title="click for bid" onclick="showdetails(<?php echo $enquiry['id']; ?>)"><span>Bid Now</span></a>
                        </p>
                    </div>
                    <div class="pro_name_third">
                        <p><span><?php echo date('d M Y',$enquiry['added_date']); ?></span></p>
                    </div>
                    <div class="pro_name_rgt">
                        <p><span><?php echo seconds2human($enquiry['endTime']); ?></span></p>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php } ?>
            <?php } ?>

        </ul>
        <?php } else { ?>
            <p style="text-align: center; margin-top: 50px;">No Quotes Available !</p>
        <?php } ?>
    </div>
    <div class="enq_cont" id="quote_detail" style="display: none;">

    </div>