<?php
class News 
{

	public $dbcon;
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}
	//Add sports	
	function admin_add($datas)
	{
	
		$datas["name"]=empty($datas["name"])?Html::seoUrl($datas["pagetitle"]):Html::seoUrl($datas["name"]);
        
        if(isset($_FILES['newsimage']['name']) and !empty($_FILES['newsimage']['name']))
		{
			$fimgname="ITFNEWS".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['newsimage']['tmp_name']);
			$objimage->save(PUBLICFILE."newsimage/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['newsimage']	=	$productimagename;
		}
		$this->dbcon->Insert('itf_news',$datas);
	}
	
	//Delete sports
	function admin_delete($UId)
	{
		$sql="delete from itf_news where id in(".$UId.")";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}

	
	//Update sports


	function admin_update($datas)
	{

        if(isset($_FILES['newsimage']['name']) and !empty($_FILES['newsimage']['name']))
		{
			$fimgname="ITFNEWS".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['newsimage']['tmp_name']);
			$objimage->save(PUBLICFILE."newsimage/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['newsimage']	=	$productimagename;
			$advertiseinfo=$this->CheckPageCms($datas['id']);
			@unlink(PUBLICFILE."newsimage/".$advertiseinfo["newsimage"]);
		}
		
        $condition = array('id'=>$datas['id']);
		$datas["name"]=Html::seoUrl($datas["name"]);
		unset($datas['id']);
		$this->dbcon->Modify('itf_news',$datas,$condition);
	}


	function ShowAllPageCms()
	{
		$sql="select * from itf_news";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	function ShowAllNewsFront()
	{
		$sql="select * from itf_news where status=1";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
	function GetPageData($id)
	{
		$sql="select * from itf_news  where id='".$id."'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}

	function CheckPageCms($UsId)
	{
		$sql="select * from itf_news where id='".$UsId."'";
		return $this->dbcon->Query($sql);
	}

	

	function PublishBlock($ids)
	{	
		$infos=$this->CheckPageCms($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_news',$datas,$condition);
		return ($infos['status']=='1')?"0":"1";
	}

	function GetArticales($pagename)
	{
		$sql="select * from itf_news where name='".$pagename."'";
		return $this->dbcon->Query($sql);
	}

	function GetMenuCms()
	{
		$sql="select id,name,pagetitle from itf_news order by id";
		$res=$this->dbcon->FetchAllResults($sql);
		$menudata=array();
		foreach($res as $dd)
		$menudata[$dd["id"]]=array("name"=>$dd["name"],"title"=>$dd["pagetitle"]);
		
		return $menudata;
	}
	
	function contactUs($datas)
	{
		
		
		$objuser=new User();
		//Admin Mail
		$emaildata=$objuser->GetEmail(4);
		$bodydata=ComposeBody($emaildata["mailbody"],$datas);
		MailSend("info@ikonnectpages.ca",$emaildata["mailsubject"],$bodydata);

		//Thnak mail
		$emaildata=$objuser->GetEmail(3);
		$bodydata=ComposeBody($emaildata["mailbody"],$datas);
		MailSend($datas["emailid"],$emaildata["mailsubject"],$bodydata);
		
		
	}
	function GetAdminEmail1(){
	
			$sql="select * from itf_users  where usertype=1";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
	
	 function Add_Contact_Request($datas)
	 {
		
	
			$email = $datas['email'];
			unset($datas['id']);
		  $this->dbcon->Insert('itf_customer_enquiry',$datas);
			$emailadmin =$this->GetAdminEmail1();
	
			$emailadmin1 = $emailadmin['email'];
			$to = $emailadmin['email'];
			$from = $datas['emailid'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Contact Enquiry On Creaseart Website';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
		<a href="https://creaseart.com/" style="color:#FFFFFF;"><img border="0" src="https://creaseart.com/template/default/images/logo.png" title="Creaseart"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Admin,</p>
						<p>There has been an enquiry placed On the Creaseart Website</p>
						<p>Following are the details of the enquirer</p>
						<p>Name : '.$datas['name'].' </p>
						<p>Email Id : '.$datas['emailid'].' </p>
						<p>Telephone : '.$datas['phone'].' </p>
						<p>Subject : '.$datas['subject'].' </p>
						<p>Message : '.$datas['comments'].' </p>
						<br /><br />
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Creaseart Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://creaseart.com/" style="color:#fff;">Creaseart</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
         	 	return $datas;
		
		
	}

	 function Add_Vendor_Request($datas)
	 {
			$email = $datas['email'];
			unset($datas['id']);
			$this->dbcon->Insert('itf_vendor_front_enquiry',$datas);
			$emailadmin =$this->GetAdminEmail1();
	
			$emailadmin1 = $emailadmin['email'];
			$to = $emailadmin['email'];
			$from = $datas['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Vendor Enquiry On Creaseart Website';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
		<a href="https://creaseart.com/" style="color:#FFFFFF;"><img border="0" src="https://creaseart.com/template/default/images/logo.png" title="Creaseart"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Admin,</p>
						<p>There has been an enquiry placed On the Creaseart Website</p>
						<p>Following are the details of the enquirer</p>
						<p>Name : '.$datas['fname'].' </p>
						<p>Email Id : '.$datas['email'].' </p>
						<p>Telephone : '.$datas['phone'].' </p>
						<p>Company : '.$datas['cname'].' </p>
						<p>Message : '.$datas['message'].' </p>
						<br /><br />
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Creaseart Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://creaseart.com/" style="color:#fff;">Creaseart</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
         	 	return $datas;
		
		
	}
	
	
	 function Add_Email_Request($datas)
	 {
		$email = $datas['email'];
			unset($datas['id']);
			  $this->dbcon->Insert('itf_customer_enquiry',$datas);
			$emailadmin =$this->GetAdminEmail1();
	
			$emailadmin1 = $emailadmin['email'];
			$to = $emailadmin['email'];
			$from = $datas['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Customer Enquiry On Creaseart Website';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
		               <a href="https://creaseart.com/" style="color:#FFFFFF;"><img border="0" src="https://creaseart.com/template/default/images/logo.png" title="Creaseart"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Admin,</p>
						<p>There has been an enquiry placed On the Creaseart Website</p>
						<p>Following are the details of the enquirer</p>
						<p>Name : '.$datas['name'].' </p>
						<p>Email Id : '.$datas['email'].' </p>
						<p>Telephone : '.$datas['phone'].' </p>
						<br /><br />
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Creaseart Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://creaseart.com/" style="color:#fff;">Creaseart</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
         	 	return $datas;
		
		
	}
		function showAllEnquiries()
		{
			$sql="select * from  itf_customer_enquiry order by id ASC";
			return $this->dbcon->FetchAllResults($sql);
		}
		
		function CheckEnquiries($UsId)
	{
		$sql="select U.* from itf_customer_enquiry U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
function getTotalCustomerEnquiry()
	{
		//echo $sql = "select * from itf_order order by id desc";
$sql="SELECT count(*) FROM itf_customer_enquiry";
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
    
    
}
?>