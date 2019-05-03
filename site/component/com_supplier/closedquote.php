<div class="active_quote close_quote">
        <?php if(count($closedQuotes) >0 ){ ?>
            <ul>
                <li>
                    <div class="pro_name2_lft">
                        <p><b>Quote Title</b></p>
                    </div>
                    <div class="pro_name2_mid">
                        <p><b>Customer Review</b></p>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php foreach($closedQuotes as $closedQuote) { $reviews = $quote->getCustomerReviews($closedQuote['id']); ?>
                    <li>
                        <div class="pro_name2_lft">
                            <p><span><?php echo $closedQuote['quote_name']; ?></span></p>
                            <p><?php echo $closedQuote['quote_desc']; ?></p>
<!--                            <p><?php echo WordLimit($closedQuote['quote_desc']); ?></p>-->
                        </div>
                        <div class="pro_name2_mid">
                            <?php if(count($reviews) >0 ) { ?>
                            <?php foreach($reviews as $review){ $id = $review['user_id'];							       if($id != $_SESSION['FRONTUSER']['id']){ 								  ?>
                             <p><?php echo $review['review_text'].'<br> <span> by '.$review['registration_id'].'</span>'; ?></p>
<!--                                <p><?php echo WordLimit($review['review_text']).'<br> <span> by '.$review['registration_id'].'</span>'; ?></p>-->
                            <?php } }?>
                            <?php } else { ?>
                                <p>No review !</p>
                            <?php } ?>
                            <div class="clear"></div>
                        </div>
						 <?php $check_rev = $quote->writebutton($closedQuote['id'],$_SESSION['FRONTUSER']['id']);
                              if(isset($check_rev) and (!empty($check_rev))){  }else{
						?>
                        <div class="pro_name2_rgt2">                         
						<?php $customer_id = $quote->customerid($closedQuote['id']); ?>
                            <p><a href="<?Php echo CreateLink(array("ajax",'quote_id'=>$closedQuote['id'],'review_user_id'=>$customer_id[0]['user_id']));?>" class="review">write review</a></p>
                        </div>
						<?php } ?>
						 <div class="bid_rgt" style='width:52px;'>
                    <p><span><a href="#" onclick="deleteclosequt(<?php echo $closedQuote['id']; ?>)"><img alt="close" src="<?php echo TemplateUrl(); ?>/images/close_btn.png"></a> </span></p>
                </div>
                        <div class="clear"></div>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p style="text-align: center; margin-top: 50px;">No closed quote available ! </p>
        <?php } ?>

    </div>