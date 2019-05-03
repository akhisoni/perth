<?php 
if(empty($_SESSION['FRONTUSER']))
{
    redirectUrl(CreateLink(array("signin","msg"=>'view')));
} 
$obj = new User();
$userinfo = $obj->getUserInfo($_SESSION['FRONTUSER']['id']);
$id = isset($_GET['id'])?$_GET['id']:'';
$prodobj = new Product();
$objquote = new Quote();
$stateobj = new State();
$objreport = new Report();
$stateobj1 = $stateobj->getAllStateFront();
$objreport1 = $objreport->showAllEnquiryByid($id);
$imge = explode(',',$objreport1['upload']);
if(isset($_POST['submit']) && !empty($_POST['chat_text'])){          
$objquote->addQuoteChat($_POST);
flashMsg("You have successfully Placed the Offer");
redirectUrl(CreateLink(array('view_request', 'itemid'=>'view_detail','id'=>$id)));
}

if(isset($_POST['submit_board']) && !empty($_POST['board_chat'])){          
$objquote->addBoardChat($_POST);
flashMsg("You have successfully Send the Message");
redirectUrl(CreateLink(array('view_request', 'itemid'=>'view_detail','id'=>$id)));
}

$boardchat = $objquote->getBoardChat($id);

?>


<section class="section">
<div class="center_main">
<div class="home">Home > <span>View Buying Requests</span></div>
<?php include('category.php'); ?>

<div class="main-about">

<div class="about-one">
<h1>View Buying Requests </h1><img src="<?php echo TemplateUrl();?>image/line-sm.png"/> 
</div>


<div class="Plucka_online">
<div class="buying_request2">

<table>
      
        
         <!--   <tr>
            <td>Buyer First Name</td>
             <td><?php echo $objreport1['name']; ?></td>
             </tr>
             <tr>
            <td>Buyer Last Name</td>
             <td><?php echo $objreport1['last_name']; ?></td>
             </tr>
             <tr>
            <td>Buyer Email Id</td>
             <td><?php echo $objreport1['email']; ?></td>
             </tr>-->
            
             <tr>
            <td>Company Name</td>
             <td><?php echo $objreport1['company_name']; ?></td>
             </tr>
            
              <tr>
            <td>Location</td>
             <td><?php echo $objreport1['location']; ?></td>
             </tr>
              <tr>
            <td>Post Code</td>
             <td><?php echo $objreport1['post_code']; ?></td>
             </tr>

              <tr>
            <td>Catalogue Category</td>
             <td><?php echo $objreport1['catalog_category']; ?></td>
             </tr>

<tr>
            <td>Catalogue Name</td>
             <td><?php echo $objreport1['catalog_name']; ?></td>
             </tr>
              <tr>
            <td>Description</td>
             <td><?php echo $objreport1['description']; ?></td>
             
             </tr>
             <tr>
                <td>Date</td>
             <td><?php echo date("d-m-Y", strtotime($objreport1['date_added']));?></td></tr>


<tr>
            <td>Upload File</td>
            <td>
            <?php $i=1;foreach($imge as $imagevalue){?>

             <a href="<?php echo PUBLICPATH."buying_request_file/".$imagevalue; ?>" target="_blank"><?php echo $imagevalue; ?> <?php echo $i++;?> | </a>
               <?php } ?>
             </td>
             
           
             </tr>
             
</table>

    <script>
        function toggle(id) {
            if (document.getElementById(id).style.display == 'none') {
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    </script>

    <form method="post" name="quote" enctype="multipart/form-data" action="">
    <input type="hidden" name="reply_id" value="<?php echo $objreport1['user_id'];?>" />
    <input type="hidden" name="user_id" value="<?php echo $userinfo['user_id'];?>" />
    <input type="hidden" name="quote_id" value="<?php echo $objreport1['id']; ?>" />
    <?php  if($objreport1['seller_id']==$userinfo['user_id']){?>
        <input type="checkbox" checked="checked" disabled="disabled" onclick="toggle('Comments')"> Offer Accepted by Buyer <br/><br/>
<?php }else {?>
<input type="checkbox" onclick="toggle('Comments')"> Check here to make an offer <br/><br/>
<?php } ?>
        
        <div id="Comments" style="display:none;">
            <textarea placeholder="Type your text here" name="chat_text" class="in-login_textarea"></textarea><br /><br />
            <input type="file" name="upload_file" id="upload_file" /> Upload zip file for multiple upload
            <div class="submit">
            <input type="submit" name="submit" value="submit" />
            </div>
        </div>
        
    </form>

</div>
<div class="buying_request3">
<h1>Clarification  Board </h1><img src="<?php echo TemplateUrl();?>image/line-sm.png"/> 

     
    <div class="chat_details">
   

    <?php foreach($boardchat as $boardchats) {?>
     <div class="chat_board">
    <div class="mess_b"><?php echo $boardchats['board_chat']; ?></div>
    <div class="mess_author">By- <?php echo $boardchats['name']; ?></div>
    </div>
    <?php } ?>
    </div>
    <h4>Enter Your Question Here </h4>
    <form method="post" name="board" enctype="multipart/form-data" action="">
    <input type="hidden" name="reply_id" value="<?php echo $objreport1['user_id'];?>" />
    <input type="hidden" name="user_id" value="<?php echo $userinfo['user_id'];?>" />
    <input type="hidden" name="quote_id" value="<?php echo $objreport1['id']; ?>" />
   
        <div id="Comments">
            <textarea placeholder="Type your text here" name="board_chat" class="in-login_textarea"></textarea><br /><br />
         
            <div class="submit">
            <input type="submit" name="submit_board" value="submit" />
            </div>
        </div>
        
    </form>
    <p>&nbsp;</p>
    </div>
</div>
</div>
</div>
</section>
