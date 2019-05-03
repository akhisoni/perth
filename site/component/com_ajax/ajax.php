<?php
    //Template::setTemplate("blank");
	$usertype = $_SESSION['FRONTUSER']['usertype'];
?>
<h2>Please enter your review</h2>
<div class='clear'></div>
<div class="review_box" style='display:block;margin-top: 42px;'> 

<form id="review" method="post" action="" >
    <input type="hidden" name="quote_id" value="<?php echo $_REQUEST['quote_id']; ?>">
	<input type="hidden" name="review_user_id" value="<?php echo $_REQUEST['review_user_id']; ?>">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['FRONTUSER']['id']; ?>">
    <textarea name="review_text" id="review_text" style="width: 100%; height: 200px;" ></textarea>
    <input type="button" id='review_button' name="submit" value="Submit" >
</form>
</div>

<script>
    $(document).ready(function() {
      var typess ='<?php echo $usertype; ?>';
        $('#review_button').click( function(){
		  //alert(typess);
            if($('#review_text').val() == '')
            {
                alert("Please enter review text. !");
                $('#review_text').focus();
            } else{

                $.ajax({
                    url: "<?php echo SITEURL; ?>/itf_ajax/index.php",
                    type :"POST",
                    data: $('#review').serialize()+"&itfpg=review",
                    success:function(msg){
                        alert('Your review is successfully submitted');
						if(typess ==2)
						{
                        window.location = ("<?php echo CreateLink(array('customer&mode=closed')); ?>");
						}else{
						   document.location.href='http://plucka.co/index.php?itfpage=supplier&mode=closedquote';
						}
						
                        //window.location.reload(true);
                    }
                });
            }
        });

    });

</script>