<?php 
 $id = isset($_GET['id'])?$_GET['id']:'';
 $usid =$_REQUEST['repid'];
 $currid = $_SESSION['FRONTUSER']['id'];


$objquote = new Quote();
$getquote = $objquote->getQuotebySellerchat($id, $usid, $currid);

if(isset($_POST['submit']) && !empty($_POST['chat_text'])){          
$objquote->addQuoteChatSeller($_POST);
flashMsg("You have successfully Place the Request");
redirectUrl(CreateLink(array("supplier&mode=listbuying")));
}

?>



<section class="section">
<div class="center_main">


<div class="buying_request">
<div class="message_box">
<?php foreach($getquote as $getquote1) { ?>
<p> <strong><?php echo $getquote1['name'];?></strong> - "<?php echo $getquote1['chat_text'];?>" &nbsp;<?php echo $getquote1['date_added'];?>&nbsp; &nbsp; <a href="<?php echo PUBLICPATH."chat_pdf/".$getquote1['upload_file']; ?>">View File</a></p>
<?php }?>
</div>
<form method="post" name="quote" enctype="multipart/form-data" action="">
    <input type="hidden" name="user_id" value="<?php echo $currid; ?>" />
    <input type="hidden" name="quote_id" value="<?php echo $id ; ?>" />
      <input type="hidden" name="reply_id" value="<?php echo $usid  ; ?>" />
  

        
        <div id="Comments">
            <textarea placeholder="Type your text here" name="chat_text" class="in-login_textarea"></textarea><br/><br/>
             <input type="file" name="upload_file" id="upload_file" /> Upload zip file for multiple upload
            <div class="submit">
            <input type="submit" name="submit" value="submit" />
            </div>
        </div>
        
    </form>
</div>



</div>
</section>
