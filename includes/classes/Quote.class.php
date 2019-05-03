<?php
class Quote
{
			public $dbcon;
			public $datas;
			
			function __construct()
			{
			global $itfmysql;
			$this->dbcon = $itfmysql;
			}
			
			public function addToQuote($data)
			{
			$product_id = $data['id'];
			$quantity = $data['quantity'];
			$_SESSION['quote'][$product_id] += (int)$quantity;
			
			return true;
			}
			public function writebutton($quote_id,$usrid)
			{
			$sql = "select * from itf_quote_review where quote_id='$quote_id' and user_id='$usrid'";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			public function getQuote()
			{
			$datas = array();
			
			if(isset($_SESSION['quote']) and count($_SESSION['quote']) > 0){
			
			$product = new Product();
			foreach($_SESSION['quote'] as $key=>$quote){
				$datas[] = array('quantity'=>$quote,'product'=>$product->CheckProductFront($key));
			}
			
			return $datas;
			} else{
			
			return $datas;
			}
			
			
			}
			
			public function getTotalQuote()
			{
			$total = 0;
			
			if(isset($_SESSION['quote']) and count($_SESSION['quote']) > 0){
			
			foreach($_SESSION['quote'] as $key=>$quote){
				$total += $quote;
			}
			
			return $total;
			} else{
			
			return $total;
			}
			
			
			}
			
			public function removeQuote($product_id)
			{
			
			if(isset($_SESSION['quote']) and count($_SESSION['quote']) > 0){
			
			unset($_SESSION['quote'][$product_id]);
			
			return true;
			} else{
			
			return false;
			}
			
			
			}



			public function discardQuote()
			{
			
			if(isset($_SESSION['quote']) and count($_SESSION['quote']) > 0){
			
			unset($_SESSION['quote']);
			
			return true;
			} else{
			
			return false;
			}
			
			
			}
			public function addbidsonquote($bid_amount,$attachment,$bid_desc,$quoteid,$usrid)
			{
			$current_date = date('Y-m-d H:i:s');
			$qry="INSERT INTO itf_bid set quote_id='$quoteid',bid_amount='$bid_amount',bid_desc='$bid_desc',
			user_id ='$usrid',date_added='$current_date',status='0',bid_closed='0',attachment='$attachment'";	
			$response = mysql_query($qry); 
			if($response)
			{
			 return true;
			}else{
			return false;
			}
			}
			public function reviews($userid)
			{
			$review="select * from itf_quote_review where review_user_id='$userid'";	
			$reviewlist = $this->dbcon->FetchAllResults($review);
			if($reviewlist)
			{
			 return $reviewlist;
			}
			else{
			 return false;
			}
			}
			
			public function username($userid)
			{
			$user="select * from itf_users where id='$userid'";	
			$userlist = mysql_fetch_assoc(mysql_query($user));
			$usr="select * from itf_quote_review where review_user_id='$userid'";	
			$reviewlist = $this->dbcon->FetchAllResults($usr);
			
			if($userlist)
			{
			 return $userlist;
			}
			else{
			 return false;
			}
			}
			public function showsuppprofile($id)
			{
			
			$qry="select * from itf_users where registration_id='$id'";	
			$response = mysql_fetch_assoc(mysql_query($qry)); 
			$rid = $response['id'];
			$qry1="select * from itf_user_profile where id='$rid'";	
			$response1 = mysql_fetch_assoc(mysql_query($qry1));
			$review="select * from itf_quote_review where review_user_id='$rid' order by id desc limit 1";	
			$reviewlist = mysql_fetch_assoc(mysql_query($review));
				
			$data = '<table>
				<tr>
				  <td>Name:</td><td>'.$response["name"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Email:</td><td>'.$response["email"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Address:</td><td>'.$response1["address"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Phone:</td><td>'.$response1["email_phone"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Company name:</td><td>'.$response1["company_name"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Review:</td><td>'.$reviewlist["review_text"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
			
			</table>';
			if($response)
			{
			 return $data;
			}else{
			return false;
			}
			}
			public function customerreview($id)
			{
			
			
			
			$qry="select * from itf_users where id='$id'";	
			$response = mysql_fetch_assoc(mysql_query($qry)); 
			
			$qry1="select * from itf_user_profile where id='$id'";	
			$response1 = mysql_fetch_assoc(mysql_query($qry1));
			$review="select * from itf_quote_review where review_user_id='$id' order by id desc limit 1";	
			$reviewlist = mysql_fetch_assoc(mysql_query($review));
				
			$data = '<table>
				<tr>
				  <td>Name:</td><td>'.$response["name"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Email:</td><td>'.$response["email"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Address:</td><td>'.$response1["address"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Phone:</td><td>'.$response1["email_phone"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				<tr>
				  <td>Company name:</td><td>'.$response1["company_name"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
				
				<tr>
				  <td>Review:</td><td>'.$reviewlist["review_text"].'</td>
				</tr><tr>&nbsp;<td>&nbsp;</td></tr>
			
			</table>';
			if($response)
			{
			 return $data;
			}else{
			return false;
			}
			}
			
			public function removeCloseQuote($quoteid)
			{
			$transfer = mysql_fetch_assoc(mysql_query("select * from itf_quote where id='".$quoteid."'"));
			$user_id = $transfer["user_id"];
			$quote_name = $transfer["quote_name"];
			$quote_desc = $transfer["quote_desc"];
			$attachment = $transfer["attachment"];
			$finish_time = $transfer["finish_time"];
			$location = $transfer["location"];
			$service_cat = $transfer["service_cat"];
			$service_id = $transfer["service_id"];
			$bidded = $transfer["bidded"];
			$date_added = $transfer["date_added"];
			$payment = $transfer["payment"];
			$quote_status = $transfer["quote_status"];
			$approve = $transfer["approve"];
			$delid = $transfer["id"];
			$qry="INSERT INTO itf_deletequotes set user_id='$user_id',quote_name='$quote_name',quote_desc='$quote_desc',
			attachment ='$attachment',finish_time='$finish_time',location='$location',service_cat='$service_cat',service_id='$service_id',
			bidded='$bidded',date_added ='$date_added',payment='$payment',quote_status='$quote_status',approve='$approve',delid='$delid'";
			
			$response = mysql_query($qry); 
			$qrydel="delete from itf_quote where id='".$quoteid."'";
			$resdel = mysql_query($qrydel);
			if($resdel)
			{
			 return true;
			}else{
			return false;
			}
			}
			
			public function addCustomQuote($datas)
			{
			
			
			$loc=$datas['location'];
			$loc1=$datas[service_id][0];	
			
			//echo "<pre>";print_r($datas);
			$admin_mail1 = $this->CheckUser($loc,$loc1);
			
			foreach($admin_mail1 as $admin_mail)
			{
			$maildatavalue = $this->GetEmail(15);
			$objmail = new ITFMailer();
			$objmail->SetSubject($maildatavalue['mailsubject']);
			$objmail->SetBody($maildatavalue['mailbody'],array('name'=>$datas['quote_name'],"time"=>$datas['finish_time']));
			$objmail->SetTo($admin_mail['email']);
			$objmail->MailSend();
			}
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			$datas['service_id'] = implode(",", $datas['service_id']);
			$user = new User();
			$info = $user->CheckUser($_SESSION['FRONTUSER']['id']);
			if($info['payment_type'] == 'account')
			{
			$datas['approve'] = 0;
			} else {
			$datas['approve'] = 1;
			}
			if(isset($_FILES['attachment']['name']) and !empty($_FILES['attachment']['name']))
			{
			$fimgname="plucka_".rand();
			$objimage= new ITFUpload();
			$objimage->load($_FILES['attachment']);
			$objimage->save(PUBLICFILE."products/".$fimgname);
			$imagename = $objimage->createnames;
			
			$datas['attachment'] = $imagename;
			}
			$quote_id = $this->dbcon->Insert('itf_quote',$datas);
			
			$quotes = $this->getQuote();
			
			if(isset($quote_id)){
			
				$info = array("quote_id"=>$quote_id,"product_id"=>$datas['product_id'],"quantity"=>$datas['quantity']);
				$this->dbcon->Insert('itf_quote_detail',$info);
			
			}
			
			$this->discardQuote();
			}
			
			public function addQuote($datas)
			{
			
			
			// echo "<pre>";print_r($datas);
			echo $loc=$datas['location'];
			$loc1=$datas[service_id][0];
			
			
			$admin_mail1 = $this->CheckUser($loc,$loc1);
			//echo "<pre>";print_r($admin_mail);
			//echo "<pre>";print_r($datas);die;
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			$user = new User();
			$info = $user->CheckUser($_SESSION['FRONTUSER']['id']);
			foreach($admin_mail1 as   $admin_mail)
			{
			$maildatavalue = $this->GetEmail(15);
			$objmail = new ITFMailer();
			$objmail->SetSubject($maildatavalue['mailsubject']);
			$objmail->SetBody($maildatavalue['mailbody'],array('name'=>$datas['quote_name'],"emailid"=>$datas['quote_desc'],"time"=>$datas['finish_time']));
			$objmail->SetTo($admin_mail['email']);
			$objmail->MailSend();
			}
			if($info['payment_type'] == 'account')
			{
			$datas['approve'] = 0;
			} else {
			$datas['approve'] = 1;
			}
			
			
			$quote_id = $this->dbcon->Insert('itf_quote',$datas);
			
			$quotes = $this->getQuote();
			
			if(isset($quote_id)){
			foreach($quotes as $quote)
			{
				$info = array("quote_id"=>$quote_id,"product_id"=>$quote['product']['id'],"quantity"=>$quote['quantity'],"price"=>$quote['product']['price']);
				$this->dbcon->Insert('itf_quote_detail',$info);
			}
			}
			
			$this->discardQuote();
			}
			public function checkQuote($quote_id)
			{
			$sql = "select Q.*,U.registration_id as customer from itf_quote Q
				LEFT JOIN itf_users U ON U.id=Q.user_id
				where Q.id ='".$quote_id."' and Q.status = 1"; 
			$datas = $this->dbcon->Query($sql);
			return $datas;
			}
			
			public function checkQuote2($quote_id,$uid)
			{
			$sql = "select D.product_id as product_id,Q.service_id as service,P.*,Q.*,U.registration_id as customer,B.bid_closed as bid_closed,B.id as bid_id,C.catname from itf_quote Q
				LEFT JOIN itf_users U ON U.id=Q.user_id
				LEFT JOIN itf_bid B ON B.quote_id=Q.id
				LEFT JOIN itf_quote_detail D ON D.quote_id = Q.id
				LEFT JOIN itf_product P ON D.product_id = P.id
				LEFT JOIN itf_category C ON P.category_id = C.id
				where Q.id ='".$quote_id."' and Q.status = 1 and B.user_id= '".$uid."'"; 
			$datas = $this->dbcon->Query($sql);
			return $datas;
			}
			
			public function getQuoteDetails($quote_id)
			{
			$sql = "select W.service_id as service,Q.*,P.*,C.catname from itf_quote_detail Q
				LEFT JOIN itf_product P ON Q.product_id = P.id
				LEFT     JOIN itf_category C ON P.category_id = C.id
					 LEFT     JOIN itf_quote W ON W.id = Q.quote_id where Q.quote_id ='".$quote_id."' and Q.status = 1 order by Q.id desc";
			$datas = $this->dbcon->FetchAllResults($sql);        
			return $datas;
			
			}
			public function getQuoteDetails_bk($quote_id)
			{
			$sql = "select Q.*,P.*,C.catname,S.catname as service_name from itf_quote_detail Q
				LEFT JOIN itf_product P ON Q.product_id = P.id
				LEFT     JOIN itf_category C ON P.category_id = C.id
					 LEFT     JOIN itf_quote W ON W.id = Q.quote_id
				   LEFT     JOIN itf_service_category S ON W.service_id = S.id
				   
				where Q.quote_id ='".$quote_id."' and Q.status = 1 order by Q.id desc";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			
			public function getOrder()
			{
			//    $user_id = $_SESSION['FRONTUSER']['id'];
			//        $sql = "select *,UNIX_TIMESTAMP(date_added) as create_date from itf_quote where user_id ='".$user_id."' and status = 1 and payment = 0 Having (UNIX_TIMESTAMP(STR_TO_DATE(finish_time,'%m/%d/%Y %H:%i:%s')) - UNIX_TIMESTAMP(now())) > 0  order by id desc ";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			public function getActiveQuote()
			{
			// $user_id = $_SESSION['FRONTUSER']['id'];
			//       $sql = "select Q.*,UNIX_TIMESTAMP(Q.date_added) as create_date,U.registration_id,L.name as location_name from itf_quote Q
			//                LEFT JOIN itf_users U ON U.id = Q.user_id
			//                LEFT JOIN itf_state L ON L.id = Q.location
			//                where Q.user_id ='".$user_id."' and Q.status = 1 and Q.payment = 1 and Q.quote_status IN(0,1) order by Q.id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			public function getClosedQuote()
			{
			// $user_id = $_SESSION['FRONTUSER']['id'];
			//        $sql = "select Q.*,UNIX_TIMESTAMP(Q.date_added) as create_date,U.registration_id,L.name as location_name from itf_quote Q
			//                LEFT JOIN itf_users U ON U.id = Q.user_id
			//                LEFT JOIN itf_state L ON L.id = Q.location
			//                where Q.user_id ='".$user_id."' and Q.status = 1 and Q.payment = 1 and Q.quote_status = 2  order by Q.id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			public function getExpiredQuote()
			{
			//$user_id = $_SESSION['FRONTUSER']['id'];
			//        $sql = "select Q.*,UNIX_TIMESTAMP(Q.date_added) as create_date,U.registration_id,L.name as location_name from itf_quote Q
			//                LEFT JOIN itf_users U ON U.id = Q.user_id
			//                LEFT JOIN itf_state L ON L.id = Q.location
			//                where Q.user_id ='".$user_id."' and Q.status = 1 and Q.id NOT IN(select quote_id from itf_bid) Having (UNIX_TIMESTAMP(STR_TO_DATE(finish_time,'%m/%d/%Y %H:%i:%s')) - UNIX_TIMESTAMP(now())) < 0 order by Q.id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			public function getEnquiryByLocation($city_ids,$cat_ids=0)
			{
			// if(!empty($city_ids)){
			//      $sql = "select *,UNIX_TIMESTAMP(date_added) as added_date,UNIX_TIMESTAMP(STR_TO_DATE(finish_time,'%m/%d/%Y %H:%i:%s')) - UNIX_TIMESTAMP(now()) as endTime from itf_quote where (location IN(".$city_ids.") and service_cat IN(".$cat_ids.")) or (location IN(".$city_ids.") and service_cat = 0 ) and id NOT IN (SELECT quote_id FROM itf_bid where user_id = '".$_SESSION['FRONTUSER']['id']."' ) and  status = 1 order by id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        } else {
			//            $datas = array();
			//        }
			//        return $datas;
			}
			
			public function getActiveQuoteByLocation($city_ids)
			{ //edited by kulbeer for bid closed for single supplier
			// if(!empty($city_ids)){
			//  $sql = "select Q.*,UNIX_TIMESTAMP(Q.date_added) as added_date,UNIX_TIMESTAMP(STR_TO_DATE(Q.finish_time,'%m/%d/%Y %H:%i:%s')) - UNIX_TIMESTAMP(now()) as endTime,L.name as location_name,U.registration_id as customer, B.bid_closed AS bid_closed from itf_quote Q
			//                LEFT JOIN itf_state L ON L.id = Q.location
			//                LEFT JOIN itf_bid B ON B.quote_id = Q.id
			//                LEFT JOIN itf_users U ON U.id = Q.user_id
			//                where location IN(".$city_ids.")  and Q.id IN(select quote_id from itf_bid where user_id ='".$_SESSION['FRONTUSER']['id']."' and status=1 and bid_closed !=2) and Q.status = 1 and Q.payment = 1 and Q.quote_status IN(0,1) order by Q.id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        } else {
			//            $datas = array();
			//        }
			//
			//        return $datas;
			}
			
			public function getClosedQuoteByLocation($city_ids)
			{
			//  if(!empty($city_ids)){
			//        $sql = "select Q.*,UNIX_TIMESTAMP(Q.date_added) as added_date,UNIX_TIMESTAMP(STR_TO_DATE(Q.finish_time,'%m/%d/%Y %H:%i:%s')) - UNIX_TIMESTAMP(now()) as endTime,L.name as location_name from itf_quote Q
			//                LEFT JOIN itf_state L ON L.id = Q.location
			//                where location IN(".$city_ids.")  and Q.id IN(select quote_id from itf_bid where user_id ='".$_SESSION['FRONTUSER']['id']."'and bid_closed =2) and Q.status = 1  order by Q.id desc";//edited by kulbeer
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        } else {
			//            $datas = array();
			//        }
			//
			//        return $datas;
			}
			
			public function GetAdminEmail1(){
			
			$sql="select * from itf_users where id=1";
			$datas=$this->dbcon->Query($sql);
			return $datas;
			}
			
		  function GetSellerEmail($id){
			$sql="select * from itf_users where id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
		
		function GetQuotebyID($id){
			$sql="select * from itf_quote where id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
		
			
			
			public function addQuoteChat($datas)
			{
				$datas['quote_id'];
				if(isset($_FILES['upload_file']['name']) and !empty($_FILES['upload_file']['name']))
				{
				$fimgname="Plucka".time();
				$objimage= new ITFUpload();
				$objimage->load($_FILES['upload_file']);
				//echo PUBLICFILE; die;
				$objimage->save(PUBLICFILE."chat_pdf/".$fimgname);
				$resumename=$objimage->GetFilename();
				$datas['upload_file']=$resumename;
				}
				
				$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
				unset($datas['id']);
				$this->dbcon->Insert('itf_quote_chat',$datas);
				$emailadmin =$this->GetAdminEmail1();
				$emailadmin1 = $emailadmin['email'];
				$quoteid =$this->GetQuotebyID($datas['quote_id']);
				$quotemail = $quoteid['email'];
				$selleremail =$this->GetSellerEmail($datas['user_id']);
				$to = $emailadmin['email'].','.$quoteid['email'];
				$from = $selleremail['email'];
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'You have received offers on Plucka';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="1" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$quoteid['name'].',</p>
						<p>Offers have made against your buying request on Plucka.</p>
						<p>Please visit your Dashboard to view these offers.</p>
						<p><a href="http://plucka.co/">www.plucka.co</a></p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Plucka Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://plucka.co/" style="color:#fff;">Plucka</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
						return $datas;
			
			}
			
			
			
				
			
			public function addBoardChat($datas)
			{
				$datas['quote_id'];
				if(isset($_FILES['upload_file']['name']) and !empty($_FILES['upload_file']['name']))
				{
				$fimgname="Plucka".time();
				$objimage= new ITFUpload();
				$objimage->load($_FILES['upload_file']);
				//echo PUBLICFILE; die;
				$objimage->save(PUBLICFILE."chat_pdf/".$fimgname);
				$resumename=$objimage->GetFilename();
				$datas['upload_file']=$resumename;
				}
				
				$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
				unset($datas['id']);
				$this->dbcon->Insert('itf_board_chat',$datas);
				$emailadmin =$this->GetAdminEmail1();
				$emailadmin1 = $emailadmin['email'];
				$quoteid =$this->GetQuotebyID($datas['quote_id']);
				$quotemail = $quoteid['email'];
				$selleremail =$this->GetSellerEmail($datas['user_id']);
				$to = $emailadmin['email'].','.$quoteid['email'];
				$from = $selleremail['email'];
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'You have received offers on Plucka';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="1" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$quoteid['name'].',</p>
						<p>Offers have made against your buying request on Plucka.</p>
						<p>Please visit your Dashboard to view these offers.</p>
						<p><a href="http://plucka.co/">www.plucka.co</a></p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Plucka Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://plucka.co/" style="color:#fff;">Plucka</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
						return $datas;
			
			}
			
			
			
			
			
			
			
			public function getQuoteChat($quote_id)
			{
			$sql = "select Q.chat_text,UNIX_TIMESTAMP(Q.date_added) as added_date,U.name,UP.profile_image from itf_quote_chat Q
				LEFT JOIN itf_users U ON Q.user_id = U.id
				LEFT JOIN itf_user_profile UP ON U.profile_id = UP.id
				where Q.quote_id ='".$quote_id."' and Q.status = 1 order by Q.id desc";
			$datas = $this->dbcon->FetchAllResults($sql);
			
			return $datas;
			}
			
			public function getBoardChat($quote_id)
			{
			 $sql = "select Q.board_chat,UNIX_TIMESTAMP(Q.date_added) as added_date,U.name,UP.profile_image from itf_board_chat Q
				LEFT JOIN itf_users U ON Q.user_id = U.id
				LEFT JOIN itf_user_profile UP ON U.profile_id = UP.id
				where Q.quote_id ='".$quote_id."' and Q.status = 1 order by Q.id desc";
			$datas = $this->dbcon->FetchAllResults($sql);
			
			return $datas;
			}

			public function showTotalQuoteAccept()
			{
			return Count($this->getActiveQuote());
			
			}
			
			public function showTotalQuoteRequest()
			{
			return Count($this->getOrder());
			}
			
			public function addActiveQuoteChat($datas)
			{
			
			$bid_id = $datas['bid_id'];
			$quote_id = $datas['quote_id'];
			$quote_status = isset($datas['quote_status'])?$datas['quote_status']:'';
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			
			$admin_mail= $this->CheckWork($datas['reciever_id']);
			//echo "<pre>";print_r($admin_mail);
			$maildatavalue = $this->GetEmail(17);
			$objmail = new ITFMailer();
			$objmail->SetSubject($maildatavalue['mailsubject']);
			$objmail->SetBody($maildatavalue['mailbody'],array('quote'=>$datas['quote_name'], 'name'=>$datas['chat_text']));
			$objmail->SetTo($admin_mail['email']);
			$objmail->MailSend();
			//echo "<pre>";print_r($admin_mail1);die;
			
			unset($datas['id']);
			$this->dbcon->Insert('itf_active_quote_chat',$datas);
			
			if(!empty($quote_status)) {
			$datas = array('bid_closed'=>$quote_status);
			$condition = array('id'=>$bid_id);
			$this->dbcon->Modify('itf_bid',$datas,$condition);//kulbeer
			}
			}
			
			public function changedBidStatus($datas)
			{   
			$bid_id = $datas['bid_id'];
			$quote_id = $datas['quote_id'];
			$quote_status = isset($datas['quote_status'])?$datas['quote_status']:'';
			$datas = array('bid_closed'=>$quote_status);
			
			$condition = array('id'=>$bid_id); 
			$this->dbcon->Modify('itf_bid',$datas,$condition);//kulbeer
			
			$sql="select * from itf_bid where quote_id='".$quote_id."' and bid_closed !='2'"; 
			$res = mysql_query($sql);
			$count = mysql_num_rows($res); 
			if($count==0)
			{
					  
			$datas = array('quote_status'=>$quote_status);
			$condition = array('id'=>$quote_id);
			$this->dbcon->Modify(' itf_quote',$datas,$condition);
			
			}
			}
			
			
			
			function getuseruniqueid(){
			
			$sql="select * from itf_users where id='".$_SESSION['FRONTUSER']['id']."'"; 
			$datas = $this->dbcon->Query($sql);
			return $datas;
			}
			function getuseridfromunique($id){
			
			$sql="select * from itf_users where registration_id='".$id."'"; 
			$datas = $this->dbcon->Query($sql);
			return $datas;
			}
			
			public function getActiveQuoteChat($quote_id,$reciever_id)
			{
			
			//echo "<pre>";print_r($reciever_id);die;
			$sql1 = "select Q.chat_text,UNIX_TIMESTAMP(Q.date_added) as added_date,U.name,UP.profile_image from 
			itf_active_quote_chat Q
				LEFT JOIN itf_users U ON Q.user_id = U.id
				LEFT JOIN itf_user_profile UP ON U.profile_id = UP.id
				where Q.quote_id ='".$quote_id."' and Q.user_id='".$_SESSION['FRONTUSER']['id']."' and Q.reciever_id ='".$reciever_id."' and Q.status = 1 order by Q.id desc";
			$datas = $this->dbcon->FetchAllResults($sql1);
			
			$useridtoreceiverid=  $this->getuseruniqueid();
			$reciveridtouserid=  $this->getuseridfromunique($reciever_id);
			//echo "<pre>";print_r($data);die;
			$sql2 = "select Q.chat_text,UNIX_TIMESTAMP(Q.date_added) as added_date,U.name,UP.profile_image from 
			itf_active_quote_chat Q
				LEFT JOIN itf_users U ON Q.user_id = U.id
				LEFT JOIN itf_user_profile UP ON U.profile_id = UP.id
				where Q.quote_id ='".$quote_id."' and Q.user_id='".$reciveridtouserid['id']."' and Q.reciever_id ='".$useridtoreceiverid['registration_id']."' and Q.status = 1 order by Q.id desc";
			$datas1 = $this->dbcon->FetchAllResults($sql2);
			
			$qdata= array_merge($datas, $datas1);
			$this->array_sort_by_column($qdata, 'added_date');
			// echo "<pre>";print_r($qdata);
			//echo "datas2"."<pre>";print_r($datas1);
			// die;
			
			
			
			
			
			
			return $qdata;
			}
			function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
			$sort_col = array();
			foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
			}
			
			array_multisort($sort_col, $dir, $arr);
			}

			public  function addBid($datas)
			{
			//echo "<pre>";print_r($datas);die;
			$id=$datas['quote_id'];
			
			
			//echo "<pre>";print_r($admin_mail);die;
			if(isset($_FILES['attachment']['name']) and !empty($_FILES['attachment']['name']))
			{
			$fimgname="plucka_".rand();
			$objimage= new ITFUpload();
			$objimage->load($_FILES['attachment']);
			$objimage->save(PUBLICFILE."pdf/".$fimgname);
			$imagename = $objimage->createnames;
			
			$datas['attachment'] = $imagename;
			}
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			unset($datas['id']);
			$this->dbcon->Insert('itf_bid',$datas);
			
			$admin_mail = $this->CheckSupp($id);
			//echo "<pre>";print_r($admin_mail);die;
			$maildatavalue = $this->GetEmail(16);
			$objmail = new ITFMailer();
			$objmail->SetSubject($maildatavalue['mailsubject']);
			$objmail->SetBody($maildatavalue['mailbody'],array('quote'=>$datas['quote_name'],'name'=>$datas['bid_desc'],"time"=>$datas['bid_amount']));
			$objmail->SetTo($admin_mail['email']);
			$objmail->MailSend();
			}
			
			public function deleteBid($id)
			{
			$sql="delete from itf_bid where id in(".$id.")";
			
			
			$this->dbcon->Query($sql);
			return $this->dbcon->querycounter;
			}
			
			public function deleteExpQu($id)
			{
			$sql="delete from itf_quote where id in(".$id.")";
			
			
			$this->dbcon->Query($sql);
			return $this->dbcon->querycounter;
			}
			
			public function getBids()
			{
			// $sql = "select B.*,Q.quote_name,Q.quote_desc from itf_bid B
			//                LEFT JOIN itf_quote Q ON Q.id = B.quote_id
			//                where B.user_id ='".$_SESSION['FRONTUSER']['id']."' order by B.id desc ";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			public function getBidsById($id)
			{
			//    $sql = "select B.*,Q.quote_name,Q.quote_desc,U.registration_id as supplier_id from itf_bid B
			//                LEFT JOIN itf_quote Q ON Q.id = B.quote_id
			//                LEFT JOIN itf_users U ON U.id = B.user_id
			//                where B.id ='".$id."' ";
			//        $datas = $this->dbcon->Query($sql);
			//        return $datas;
			}
			
			public function getBidsByQuote($quote_id)
			{
			// $sql = "select B.*,Q.quote_name,Q.quote_desc,U.registration_id as supplier_id from itf_bid B
			//                LEFT JOIN itf_quote Q ON Q.id = B.quote_id
			//                LEFT JOIN itf_users U ON U.id = B.user_id
			//                where B.quote_id ='".$quote_id."' ";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			public function getBidsByQuotes($quote_id)
			{
			//$sql = "select B.*,Q.quote_name,Q.quote_desc,U.registration_id as supplier_id from itf_bid B
			//                LEFT JOIN itf_quote Q ON Q.id = B.quote_id
			//                LEFT JOIN itf_users U ON U.id = B.user_id
			//                where B.quote_id ='".$quote_id."' and B.status='1' and  B.bid_closed!='2' ";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}
			
			
			public function getDetailFromPayment($quote_id,$uid)
			{
			$sql = "select b.* ,u.registration_id from itf_bid b
				LEFT JOIN itf_users u ON u.id = b.user_id
			
			where b.quote_id ='".$quote_id."' and b.user_id='".$uid."'";
			$datas = $this->dbcon->Query($sql);
			return $datas;
			}
			
			public function isBidded($quote_id)
			{
			
			$sql = "Select * from itf_bid where quote_id = '".$quote_id."' and user_id = '".$_SESSION['FRONTUSER']['id']."'  ";
			$datas = $this->dbcon->Query($sql);
			
			if($datas) {
			
			return true;
			} else {
			
			return false;
			}
			
			}
			
			public function getBidStatus($status){
			if($status == 0){
			$datas = 'Pending';
			} elseif($status == 1){
			$datas = 'Accepted';
			} elseif($status == 2){
			$datas = 'Not Accepted';
			}
			
			
			return $datas;
			
			}
			
			public function getQuoteStatus($status){
			if($status == 0){
			$datas = 'In Progress';
			} elseif($status == 1){
			$datas = 'Pending';
			} elseif($status == 2){
			$datas = 'Complete';
			}
			
			
			return $datas;
			
			}
			
			public function addCart($datas)
			{
			unset($_SESSION['cart']);
			foreach($datas['bid_check'] as $bid){
			
			$_SESSION['cart'][$bid] = $datas['quote_id'];
			}
			
			return true;
			}
			
			public function removeCart($id)
			{
			
			unset($_SESSION['cart'][$id]);
			
			return true;
			}
			
			public function getCart()
			{
			$datas = array();
			
			if(isset($_SESSION['cart']) and count($_SESSION['cart']) > 0){
			
			foreach($_SESSION['cart'] as $key=>$cart){
				$data = $this->getBidsById($key);
				$productData = $this->getQuoteDetails($cart);
				$data['product'] = $productData;
				$data['quote_id'] = $cart;
				$datas[] = $data;
			}
			
			return $datas;
			} else{
			
			return $datas;
			}
			}
			
			
			public function getTotalPrice()
			{
			$total = 0;
			
			if(isset($_SESSION['cart']) and count($_SESSION['cart']) > 0){
			
			foreach($_SESSION['cart'] as $key=>$cart){
				$datas = $this->getBidsById($key);
			
				$total += $datas['bid_amount'];
			}
			
			return $total;
			} else{
			
			return $total;
			}
			}
			
			public function emptyCart()
			{
			unset($_SESSION['cart']);
			
			return true;
			}
			
			public function addReview($datas)
			{
			unset($datas['id']);
			$this->dbcon->Insert('itf_quote_review',$datas);
			}
			
			public function customerid($quote_id)
			{
			$sql = "select * from itf_quote where id='$quote_id'";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			public function supllrid($quote_id)
			{
			$sql = "select * from itf_bid where quote_id='$quote_id' and bid_closed='2'";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			
			public function getCustomerReviews($quote_id)
			{
			$sql = "select R.*,U.registration_id from itf_quote_review R
				INNER JOIN itf_users U ON R.user_id = U.id and (U.usertype = 2 or U.usertype = 4)
				where R.quote_id ='".$quote_id."' ";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			
			public function getSupplierReviews($quote_id)
			{
			$sql = "select R.*,U.registration_id from itf_quote_review R
				INNER JOIN itf_users U ON R.user_id = U.id and (U.usertype = 3 or U.usertype = 4)
				where R.quote_id ='".$quote_id."' ";
			$datas = $this->dbcon->FetchAllResults($sql);
			return $datas;
			}
			
			function getTotalQuoteByUser($user_id){
			$sql = "select count(id) as total from itf_quote where user_id ='".$user_id."' ";
			$datas = $this->dbcon->Query($sql);
			
			return isset($datas['total'])?$datas['total']:"0";
			
			}
			
			public function totalMoney()
			{
			$total = 0;
			$sql = "Select B.*,SUM(B.bid_amount) as total from itf_bid B
				INNER JOIN itf_quote Q on Q.id = B.quote_id and Q.payment = 1
				where B.user_id = '".$_SESSION['FRONTUSER']['id']."'";
			$datas = $this->dbcon->FetchAllResults($sql);
			
			foreach($datas as $data)
			{
			$total += $data['bid_amount'];
			}
			
			
			return $total;
			}
			
			public function addMoney($datas)
			{
			unset($datas['id']);
			$this->dbcon->Insert('itf_money_request',$datas);
			}
			
			public function getAllTransactions()
			{
			//$user_id = $_SESSION['FRONTUSER']['id'] ;
			//        $sql = "select O.*,Q.quote_name,Q.quote_desc,P.txn_id,P.date_added as payment_date,P.payment_status from itf_order O
			//                LEFT JOIN itf_quote Q on Q.id = O.quote_id
			//                LEFT JOIN itf_payment P on P.order_id = O.id
			//                 where O.user_id ='".$user_id."' and O.status = 1 order by O.id desc";
			//        $datas = $this->dbcon->FetchAllResults($sql);
			//        return $datas;
			}

			function CheckState($id)
			{
			$sql="select * from itf_quote where id='".$id."'";
			return $this->dbcon->Query($sql);
			}
			//Function for change status
			function PublishBlock($ids)
			{
			
			$infos = $this->CheckState($ids);
			if($infos['approve']=='1')
			$datas=array('approve'=>'0');
			else
			$datas=array('approve'=>'1');
			
			$condition = array('id'=>$ids);
			$this->dbcon->Modify('itf_quote',$datas,$condition);
			
			return ($infos['approve']=='1')?"0":"1";
			
			}
			function CheckUser($id,$service_id)
			{
			//echo $id, $service_id; 
			//echo "select * from itf_user_profile where FIND_IN_SET($id,city_id) and FIND_IN_SET($service_id,service_category)";
			
			$sql="select * from itf_user_profile where FIND_IN_SET($id,city_id) and FIND_IN_SET($service_id,service_category)";
			return $this->dbcon->FetchAllResults($sql);
			}
			
			function CheckSupp($id)
			{
			
			
			$sql="select  u.email from itf_bid b 
				INNER JOIN itf_quote q on b.quote_id = q.id 
				INNER JOIN itf_users u on q.user_id = u.id
				WHERE b.quote_id = '".$id."'";
			
			return $this->dbcon->Query($sql);
			}
			
			function CheckWork($id)
			{
			
			$sql="select * from itf_users where registration_id='".$id."'";
			return $this->dbcon->Query($sql);
			}
			
			function getsupplier($id)
			{
			$sql="select * from itf_bid where id='".$id."'";
			return $this->dbcon->Query($sql);
			}
			function getsupplierbyid($id)
			{
			$sql="select * from itf_users where id='".$id."'";
			return $this->dbcon->Query($sql);
			}
			
			function GetEmail($id)
			{
			$sql="select * from itf_mails where id='".$id."'";
			return $this->dbcon->Query($sql);
			}
			
			   
	   
			public function getAllQuotebyID($id){
			$sql = "select DISTINCT R.user_id,U.name from itf_quote_chat R
			INNER JOIN itf_users U ON R.user_id = U.id and (U.usertype = 3 or U.usertype = 4)
			where R.quote_id ='".$id."' and user_id!= '".$_SESSION['FRONTUSER']["id"]."' order by date_added ";
			//$sql="select * from itf_quote_chat where quote_id='".$id."' order by date_added";
			return $this->dbcon->FetchAllResults($sql);
			}
		  
			public function getQuotebyUser($id,$usid,$currid){
			$sql = "select R.*,U.name from itf_quote_chat R
			INNER JOIN itf_users U ON R.user_id = U.id 
			where R.quote_id ='".$id."' AND R.user_id='".$usid."' OR R.reply_id='".$usid."' order by date_added ";
			//$sql="select * from itf_quote_chat where quote_id='".$id."' order by date_added";
			return $this->dbcon->FetchAllResults($sql);
			}

			public function getQuotebySeller($usid)
			{
			$sql = "select *,R.user_id as usid ,U.* from itf_quote R
			INNER JOIN itf_quote_chat U ON R.id = U.quote_id 
			where  U.user_id='".$usid."' Group by U.quote_id ";
			//$sql="select * from itf_quote_chat where quote_id='".$id."' order by date_added";
			return $this->dbcon->FetchAllResults($sql);
			}
			
			public function getQuotebySellerchat($id,$usid,$currid)
			{
		    $sql = "select R.*,U.name from itf_quote_chat R
			INNER JOIN itf_users U ON R.user_id = U.id 
			where R.quote_id ='".$id."' AND R.user_id='".$currid."' OR R.reply_id='".$currid."' order by date_added ";
			//$sql="select * from itf_quote_chat where quote_id='".$id."' order by date_added";
			return $this->dbcon->FetchAllResults($sql);
			}

			public function addQuoteChatReply($datas)
			{
				if(isset($_FILES['upload_file']['name']) and !empty($_FILES['upload_file']['name']))
		{
			$fimgname="Plucka".time();
			$objimage= new ITFUpload();
			$objimage->load($_FILES['upload_file']);
			//echo PUBLICFILE; die;
			$objimage->save(PUBLICFILE."chat_pdf/".$fimgname);
			$resumename=$objimage->GetFilename();
			$datas['upload_file']=$resumename;
		}
			$datas['reply_user'] = $_SESSION['FRONTUSER']['id'];
			unset($datas['id']);
			$this->dbcon->Insert('itf_quote_chat',$datas);
			}

			public function addQuoteChatSeller($datas)
			{
				if(isset($_FILES['upload_file']['name']) and !empty($_FILES['upload_file']['name']))
		{
			$fimgname="Plucka".time();
			$objimage= new ITFUpload();
			$objimage->load($_FILES['upload_file']);
			//echo PUBLICFILE; die;
			$objimage->save(PUBLICFILE."chat_pdf/".$fimgname);
			$resumename=$objimage->GetFilename();
			$datas['upload_file']=$resumename;
		}
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			unset($datas['id']);
			$this->dbcon->Insert('itf_quote_chat',$datas);
			}

}

?>