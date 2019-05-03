<?php
class User 
{

	private $username;
	private $password;
	private $name;
	private $uertype;
	private $UserStatus;
	public $dbcon;

	function __construct()
	{
			global $itfmysql;
			$this->dbcon=$itfmysql;
	}


	function Get_User($id)
	{
	 $sql="select * from itf_users where id='".$id."'";
		return $this->dbcon->Query($sql);
	}
        
        
           function SelectMail()
	{
		$sql="select email from  itf_users  where usertype='1'";
             
                
                return $this->dbcon->Query($sql);
	}


	function loginAdminUser($uname,$pass)
	{
		$sql="select * from itf_users where username='".$this->dbcon->EscapeString($uname)."' and 	password ='".$this->dbcon->EscapeString(md5($pass))."'";
		if($DD=$this->dbcon->Query($sql))
		{
			$_SESSION['LoginInfo']=array('USNAME'=>$DD['name'],'USINFO'=>$DD['email'],'USERID'=>$DD['id'],'USERTYPE'=>$DD['usertype']);
			return '1';
		}
		else
		return '0';
	}

	

	function userLogin($email,$pass)
	{
		  $sql="select U.* from itf_users U
                    INNER JOIN itf_user_profile P on U.profile_id = P.id
                    where U.email='".$this->dbcon->EscapeString($email)."' and U.password='".md5($this->dbcon->EscapeString($pass))."' and U.status ='1' ";   
          if($DD=$this->dbcon->Query($sql)) 
                {
			$_SESSION['FRONTUSER'] = $DD;
			
						
		return '1';
		
				}

		else
		return '0';
        }

	function logout()
	{
		session_unset();
		
	}

	

	function user_add($datas)
	{
		unset($datas['id']);
		$this->dbcon->Insert('itf_users',$datas);

	}

	function admin_update($datas){
        $condition = array('id'=>$datas['id']);
        unset($datas['id']);

        $this->dbcon->Modify('itf_users',$datas,$condition);
    }

	function user_update($datas)
	{
            
        $userinfo = $this->CheckUser($datas['id']);
        $profile_info = $this->CheckProfile($userinfo['profile_id']);
        $condition = array('id'=>$datas['id']);
        $profile_condition = array('id'=>$profile_info['id']);
        unset($datas['id']);
        if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
        }
          if(empty($datas['password2']))
        {
            unset($datas['password2']);
        }else{
            $datas['password2'] =  $datas['password2'];
        }
        
          if($datas['productGroup']){
            $datas['product_group_id'] = implode(",", $datas['productGroup']);
        }
        if($datas['serviceArea']){
            $datas['city_id'] = implode(",", $datas['serviceArea']);
        }
        if($datas['serviceGroup']){
            $datas['service_category'] = implode(",", $datas['serviceGroup']);
        }
        
        $this->dbcon->Modify('itf_users',$datas,$condition);
        $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
	}
        
		function Admin_Customer_Update($datas)
	{
            
        $userinfo = $this->CheckUser($datas['id']);
        $profile_info = $this->CheckProfile($userinfo['profile_id']);
        $condition = array('id'=>$datas['id']);
        $profile_condition = array('id'=>$profile_info['id']);
        unset($datas['id']);
        if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
        }
          if(empty($datas['password2']))
        {
            unset($datas['password2']);
        }else{
            $datas['password2'] =  $datas['password2'];
        }
        
        $this->dbcon->Modify('itf_users',$datas,$condition);
        $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
	}
        
		
		
	function vendor_update($datas)
	{
		
		   if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
        }
          if(empty($datas['password2']))
        {
            unset($datas['password2']);
        }else{
            $datas['password2'] =  $datas['password2'];
        }
	    
        $userinfo = $this->CheckUser($datas['id']);
        $profile_info = $this->CheckProfile($userinfo['profile_id']);
    
		
		$condition = array('id'=>$datas['id']);
        $profile_condition = array('id'=>$profile_info['id']);
		
		    if(isset($_FILES['company_logo']['name']) and !empty($_FILES['company_logo']['name']))
		{
			$fimgname="member_company".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['company_logo']['tmp_name']);
			$objimage->save(PUBLICFILE."company_logo/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['company_logo']	=	$productimagename;
			$advertiseinfo=$this->CheckUser($datas['id']);
			@unlink(PUBLICFILE."company_logo/".$advertiseinfo["company_logo"]);
		}
		
		 if(isset($_FILES['profile_image']['name']) and !empty($_FILES['profile_image']['name']))
		{
			$fimgname="member_profile".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['profile_image']['tmp_name']);
			$objimage->save(PUBLICFILE."profile/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['profile_image']	=	$productimagename;
			$advertiseinfo=$this->CheckUser($datas['id']);
			@unlink(PUBLICFILE."profile/".$advertiseinfo["company_logo"]);
		}
        unset($datas['id']);
      
        
         
        
        $this->dbcon->Modify('itf_users',$datas,$condition);
        $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
	}
        
        
        function member_update($datas)
	{
        
        $condition = array('id'=>$datas['id']);
        $this->dbcon->Modify('itf_membership',$datas,$condition);
        
	}
        
        
          function memberadded($datas)
	{
              
                

   $this->dbcon->Insert('itf_membership',$datas);
     
	}
        

    function front_user_update($datas){
    //print_r($datas); die; 
	       $userinfo = $this->CheckUser($datas['id']);
        $profile_info = $this->CheckProfile($userinfo['profile_id']);
        $condition = array('id'=>$datas['id']);
        $profile_condition = array('id'=>$profile_info['id']);
        unset($datas['id']);

        if(isset($_FILES['image']['name'])){
            if(!empty($_FILES['image']['name'])){
                @unlink(PUBLICFILE."profile/".$profile_info['profile_image']);
                $fimgname="plucka_".$datas['name']."_".rand();
                $objimage= new ITFImageResize();
                $objimage->load($_FILES['image']['tmp_name']);
                $objimage->save(PUBLICFILE."profile/".$fimgname);
                $imagename = $objimage->createnames;

                $datas['profile_image'] = $imagename;
            }
        }
        if(isset($datas['serviceArea']) and !empty($datas['serviceArea'])){
            $datas['city_id'] = implode(',',$datas['serviceArea']);
        }

        if(isset($datas['serviceGroup']) and !empty($datas['serviceGroup'])){
            $datas['service_category'] = implode(',',$datas['serviceGroup']);
        }    
		
		$datas['email']=$datas['emailid'];
        $this->dbcon->Modify('itf_users',$datas,$condition);
        $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
    }


	function user_delete($Id)
	{
		$profile = $this->getUserInfo($Id);
        $sql1="delete from itf_user_profile where id in(".$profile['profile_id'].")";
        $this->dbcon->Query($sql1);

        $sql="delete from itf_users where id in(".$Id.")";
		$this->dbcon->Query($sql);

		return $this->dbcon->querycounter;
	}
	
		function rider_delete($Id)
	{
		$profile = $this->getRiderInfoByProfileId($Id);
	//
	if($profile){
        $sql1="delete from itf_user_profile where id in(".$profile['id'].")";
        $this->dbcon->Query($sql1);

        $sql="delete from itf_users where profile_id in(".$profile['profile_id'].")";
		$this->dbcon->Query($sql);
	}
		return $this->dbcon->querycounter;
	}
        
        
	function member_delete($Id)
	{
        $sql="delete from itf_membership where id in(".$Id.")";
        $this->dbcon->Query($sql);
        return $this->dbcon->querycounter;;
	}

	

	function ShowAllUser()
	{
		$sql="select *  from itf_users";
		return $this->dbcon->FetchAllResults($sql);

	}
	
	function ShowAllMember()
	{
	
	 $sql="select M.*,U.usertype  from itf_users M LEFT JOIN itf_usertype U on U.orders = M.usertype where M.usertype != 1 ";
		//$sql="select *  from itf_users where usertype=";
		return $this->dbcon->FetchAllResults($sql);

	}
	
	function ShowAllCustomerSearch($txtsearch)

	{

		$sql="select M.*,U.usertype  from itf_users M LEFT JOIN itf_usertype U on U.orders = M.usertype where M.name like '%".$this->dbcon->EscapeString($txtsearch)."%' or  M.email like '%".$this->dbcon->EscapeString($txtsearch)."%'";            
		return $this->dbcon->FetchAllResults($sql);

	}

	function ShowAllModeratorSearch($txtsearch)
	{
		$sql="select M.*,U.usertype  from itf_users M LEFT JOIN itf_usertype U on U.orders = M.usertype where M.name like '%".$this->dbcon->EscapeString($txtsearch)."%' or  M.email like '%".$this->dbcon->EscapeString($txtsearch)."%'";            
		return $this->dbcon->FetchAllResults($sql);
	}


	function ShowAllRiderSearch($txtsearch)
	{
		$sql="select M.*,U.usertype  from itf_users M LEFT JOIN itf_usertype U on U.orders = M.usertype where M.name like '%".$this->dbcon->EscapeString($txtsearch)."%' or  M.email like '%".$this->dbcon->EscapeString($txtsearch)."%'";            
		return $this->dbcon->FetchAllResults($sql);
	}
	
	function ShowAllCustomeruserSearch($txtsearch)

	{

		$sql="select * from itf_users where name like '%".$this->dbcon->EscapeString($txtsearch)."%' or email like '%".$this->dbcon->EscapeString($txtsearch)."%' and usertype = 2";              
		return $this->dbcon->FetchAllResults($sql);

	}
	
		function ShowAllSupplieruserSearch($txtsearch)

	{

		$sql="select * from itf_users where name like '%".$this->dbcon->EscapeString($txtsearch)."%' or email like '%".$this->dbcon->EscapeString($txtsearch)."%' and usertype = 3";      
		       
		return $this->dbcon->FetchAllResults($sql);

	}
	
	
		function ShowAllBothuserSearch($txtsearch)

	{

		$sql="select * from itf_users where name like '%".$this->dbcon->EscapeString($txtsearch)."%' or email like '%".$this->dbcon->EscapeString($txtsearch)."%' and usertype = 4";      
		       
		return $this->dbcon->FetchAllResults($sql);

	}
	

    function ShowAllCustomer()
    {
        $sql="select *  from itf_users where usertype = 2";
        return $this->dbcon->FetchAllResults($sql);

    }
     function ShowAllModerator()
    {
        $sql="select *  from itf_users where usertype = 4";
        return $this->dbcon->FetchAllResults($sql);

    }
    
	    function ShowAllRider()
    {
        $sql="select *  from itf_users where usertype = 5";
        return $this->dbcon->FetchAllResults($sql);

    }
	
    function ShowAllBoth()
    {
        $sql="select *  from itf_users where usertype = 4";
        return $this->dbcon->FetchAllResults($sql);

    }
	function ShowAllOrderCustomerSearch($phone)
    {
       
		$sql="select U.id as user_id,U.*, P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=4 and P.email_phone='".$phone."'";
        return $this->dbcon->FetchAllResults($sql);

    }

    function ShowAllSupplier()
    {
       
		$sql="select U.id as user_id,U.*, P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=3";
        return $this->dbcon->FetchAllResults($sql);

    }
    
	 function ShowAllSupplierAdmin()
    {
       $sql="select U.id as user_id,U.*, P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=3 and U.status=1";
        return $this->dbcon->FetchAllResults($sql);

    }
    
    function ShowAllMemberPlan()
    {
        $sql="select *  from itf_membership";
        return $this->dbcon->FetchAllResults($sql);

    }

    function ShowAllRequests()
    {
        $sql="select M.*,U.name  from itf_money_request M LEFT JOIN itf_users U on U.id = M.user_id";
        return $this->dbcon->FetchAllResults($sql);

    }

	
	function ShowAllUserSearch($txtsearch)
	{
		$sql="select * from itf_users where  name like ( '%".$this->dbcon->EscapeString($txtsearch)."%')";
		return $this->dbcon->FetchAllResults($sql);
	}

	

	function CheckUser($UsId)
	{
		$sql="select * from itf_users where id='".$UsId."'"; 
	 	   return $this->dbcon->Query($sql);
	}

    function CheckProfile($id)
    {
        $sql="select * from itf_user_profile where id='".$id."'";
        return $this->dbcon->Query($sql);
    }
	
  function CheckRider($id)
    {
        $sql="select * from itf_users where profile_id='".$id."' and usertype=5";
        return $this->dbcon->Query($sql);
    }

  function CheckVendor($id)
    {
        $sql="select * from itf_users where profile_id='".$id."' and usertype=3";
        return $this->dbcon->Query($sql);
    }


  function CheckProfileIDUser($id)
    {
           $sql="select * from itf_users where profile_id='".$id."'";
        return $this->dbcon->Query($sql);
    }

function CheckProfileUsers($id)
    {
     $sql="select U.id as user_id,U.*, P.* from itf_users U
          LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.profile_id='".$id."'";
        return $this->dbcon->Query($sql);
    }
    function getUserInfo($UsId)
    {
        
        //echo "<pre>";print_r($UsId);die;
        $sql="select U.id as user_id,U.*,UNIX_TIMESTAMP(U.entrydate) as created_date,P.*,C.country_name from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              LEFT JOIN itf_country C ON C.country_code = P.country_code
              where U.id='".$UsId."' ";
        return $this->dbcon->Query($sql);
    }
	
	 function getVendorInfoByProfileId($UsId)
    {
        
        //echo "<pre>";print_r($UsId);die;
       $sql="select U.id as user_id,U.*,UNIX_TIMESTAMP(U.entrydate) as created_date,P.*,C.country_name from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              LEFT JOIN itf_country C ON C.country_code = P.country_code
              where P.id='".$UsId."' ";
        return $this->dbcon->Query($sql);
    }
    
   function CheckMembership($UsId)
	{
		$sql="select U.* from itf_membership U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}


	//Function for change status	

	function PublishBlock($ids)
	{	
		$infos=$this->CheckUser($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_users',$datas,$condition);
		
		return ($infos['status']=='1')?"0":"1";

	}
        
        
        function PublishMember($ids)
	{	
		$infos=$this->CheckMembership($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_membership',$datas,$condition);
		
		return ($infos['status']=='1')?"0":"1";

	}


	
	function ChangePassword()
	{
		$userid = $_SESSION['LoginInfo']['USERID'];
		$userinfo = $this->CheckUser($userid);
		$data=$_REQUEST;

		if($userinfo['password']==md5($data["oldpassword"]))
		{
			$datas=array('password'=>md5($data["newpassword"]),'password2'=>$data["newpassword"]);
			$condition = array('id'=>$userid);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			return true;
		}
		else
		{
			return false;
		}
	}

    function ChangePasswordFront($newpassword)
    {
        $userid = $_SESSION['FRONTUSER']['id'];
        $userinfo = $this->CheckUser($userid);

        $datas=array('password'=>md5($newpassword),'password2'=>$newpassword);
        $condition = array('id'=>$userid);
        $this->dbcon->Modify('itf_users',$datas,$condition);
        return true;

    }

	function GetEmail($id)
	{
		$sql="select * from itf_mails where id='".$id."'";
		return $this->dbcon->Query($sql);
	}
	

	function forgotPasswordAdmin($tomail)
	{

        $userdetail = $this->CheckEmail($tomail);

		if(isset($userdetail['id']))
		{
			$newpass = "austad".substr(time(),-4);
			$datas = array('password'=>md5($newpass),'password2'=>$newpass);
			$condition = array('id'=>$userdetail['id']);
			unset($datas['id']);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			//$maildatavalue = $this->GetEmail(9);
//			$objmail=new ITFMailer();
//			$objmail->SetSubject($maildatavalue['mailsubject']);
//			$objmail->SetBody($maildatavalue['mailbody'],array('username'=>$userdetail['username'],"password"=>$newpass));
//            $objmail->SetTo($userdetail['emailid']);
//			$objmail->MailSend();
//			return true;
                $to = $userdetail['email'];
				$from = 'team@plucka.com.au';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				//$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				 
				$subject = 'Forgot Password';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="1" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$userdetail['name'].',</p>
						<p>Your new Login are as follows,</p>
						<p>Username : '.$userdetail['username'].'</p>
						<p>Password : '.$newpass.'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with Plucka and find it a very useful buying tool.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Plucka Team </strong></p>
						P  1300 671 660 <br/>
						E  team@plucka.com.au<br/>
						W  http://plucka.co

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://plucka.co/" style="color:#fff;">Plucka</a></td>
						</tr>
						</table>';
                $ok = @mail($to , $subject, $message, $headers); 
		}
		else
			return false;
		
	}

	
	function customerRegister($datas)
	{            
          
		 $datas['password2']=$datas['password'];
            //echo "<pre>";print_r($datas);die;
        $userinfo = $this->CheckMembership($datas['memberid']);
             //echo "<pre>";print_r($userinfo);die;
          $type=$userinfo['type'];
         $day=$userinfo['duration_day'];
         $durationtime=$userinfo['duration_type'];
         $end = date('Y-m-d', strtotime('+'.$day .$durationtime));
    
     //echo $total=$day+$durationtime;die;
        $admin_mail = $this->CheckUser(1);
        $objsite = new Site();
        $siteinfo = $objsite->CheckSite("1");

		unset($datas['id']);
                
                
                  if($datas['productGroup']){
            $datas['product_group_id'] = implode(",", $datas['productGroup']);
        }
        if($datas['serviceArea']){
            $datas['city_id'] = implode(",", $datas['serviceArea']);
        }
        if($datas['serviceGroup']){
            $datas['service_category'] = implode(",", $datas['serviceGroup']);
        }
		$datas["password"] = md5($datas["password"]);
                
                if($type=="Customer")
                {
                   $datas["usertype"] = "2"; 
                   $datas["registration_id"] = 'CPL'.time();
                    
                }
                elseif ($type=="Supplier") {
                       $datas["usertype"] = "3"; 
                        $datas["registration_id"] = 'SPL'.time();
                
                        }
            else {
                         $datas["usertype"] = "4";
                          $datas["registration_id"] = 'BPL'.time();
                 }
		//$datas["usertype"] = "2";
               $datas["expiry_date"] =$end;
               //echo "<pre>";print_r($datas);die;
       
//        if($datas['payment_type']=="account"){
//            $datas['status'] = 0;
//            $maildatavalue = $this->GetEmail(12);
//            $objmail = new ITFMailer();
//            $objmail->SetSubject($maildatavalue['mailsubject']);
//            $objmail->SetBody($maildatavalue['mailbody'],array('name'=>$datas['name'],"emailid"=>$datas['email']));
//            $objmail->SetTo($admin_mail['email']);
//            $objmail->MailSend();
//        }
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
                
                
		$maildatavalue = $this->GetEmail(2);
		$objmail = new ITFMailer();
		$objmail->SetSubject($maildatavalue['mailsubject']);
		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
		$objmail->SetTo($datas['email']);
		$objmail->MailSend();
		return $userid;
   
	}
        
        
       function userRegisterAfterPayment()
       {
            $sql = "Select * from itf_users_temp where id = '".$_SESSION['temId']."' ";
            $datas = $this->dbcon->Query($sql);
            unset($datas['id']);  unset($_SESSION['temId']);      
           
            $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
            $datas["profile_id"] = $profileid;
	    $userid = $this->dbcon->Insert('itf_users',$datas);                
                
		$maildatavalue = $this->GetEmail(2);
		$objmail = new ITFMailer();
		$objmail->SetSubject($maildatavalue['mailsubject']);
		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
		$objmail->SetTo($datas['email']);
		$objmail->MailSend();
		return $userid;
            
       }
        
        
        
        
        
        
        function customerRegisterTemp($datas)
	{           
        $datas['password2']=$datas['password'];
            //echo "<pre>";print_r($datas);die;
        $userinfo = $this->CheckMembership($datas['memberid']);
             //echo "<pre>";print_r($userinfo);die;
          $type=$userinfo['type'];
         $day=$userinfo['duration_day'];
         $durationtime=$userinfo['duration_type'];
         $end = date('Y-m-d', strtotime('+'.$day .$durationtime));
    
     //echo $total=$day+$durationtime;die;
        $admin_mail = $this->CheckUser(1);
        $objsite = new Site();
        $siteinfo = $objsite->CheckSite("1");

		unset($datas['id']);
                 if($datas['productGroup']){
            $datas['product_group_id'] = implode(",", $datas['productGroup']);
        }
        if($datas['serviceArea']){
            $datas['city_id'] = implode(",", $datas['serviceArea']);
        }
        if($datas['serviceGroup']){
            $datas['service_category'] = implode(",", $datas['serviceGroup']);
        }
                
                
		$datas["password"] = md5($datas["password"]);
                
                if($type=="Customer")
                {
                   $datas["usertype"] = "2"; 
                   $datas["registration_id"] = 'CPL'.time();
                    
                }
                elseif ($type=="Supplier") {
                       $datas["usertype"] = "3"; 
                       $datas["registration_id"] = 'SPL'.time();
                
                        }
            else {
                         $datas["usertype"] = "4";
                         $datas["registration_id"] = 'BPL'.time();
                 }
		//$datas["usertype"] = "2";
               $datas["expiry_date"] =$end;
               //echo "<pre>";print_r($datas);die;
//        $datas["registration_id"] = 'CPL'.time();
//        if($datas['payment_type']=="account"){
//            $datas['status'] = 0;
//            $maildatavalue = $this->GetEmail(12);
//            $objmail = new ITFMailer();
//            $objmail->SetSubject($maildatavalue['mailsubject']);
//            $objmail->SetBody($maildatavalue['mailbody'],array('name'=>$datas['name'],"emailid"=>$datas['email']));
//            $objmail->SetTo($admin_mail['email']);
//            $objmail->MailSend();
//        }
        $profileid = $this->dbcon->Insert('itf_users_temp',$datas);
        //$datas["profile_id"] = $profileid;
		//$userid = $this->dbcon->Insert('itf_users_temp',$datas);
                
                
//		$maildatavalue = $this->GetEmail(2);
//		$objmail = new ITFMailer();
//		$objmail->SetSubject($maildatavalue['mailsubject']);
//		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"emailid"=>$datas['email'],"password"=>$_POST['password']));
//		$objmail->SetTo($datas['email']);
//		$objmail->MailSend();
		return $profileid;
	}
        
    function supplierRegister($datas)
	{
     
 
        unset($datas['id']);
        $datas["registration_id"] = 'SPL'.time();
        if($datas['productGroup']){
            $datas['product_group_id'] = implode(",", $datas['productGroup']);
        }
        if($datas['serviceArea']){
            $datas['city_id'] = implode(",", $datas['serviceArea']);
        }
        if($datas['serviceGroup']){
            $datas['service_category'] = implode(",", $datas['serviceGroup']);
        }

        $datas["password"] = md5($datas["password"]);
        $datas["usertype"] = "3";
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
        $userid = $this->dbcon->Insert('itf_users',$datas);

        $maildatavalue = $this->GetEmail(3);
        $objmail = new ITFMailer();
        $objmail->SetSubject($maildatavalue['mailsubject']);
        $objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"emailid"=>$datas['email'],"password"=>$_POST['password']));
        $objmail->SetTo($datas['email']);
        $objmail->MailSend();
        return $userid;
	}
        
        
         function supcusRegister($datas)
	{
     
 
        unset($datas['id']);
        $datas["registration_id"] = 'SPL'.time();
        if($datas['productGroup']){
            $datas['product_group_id'] = implode(",", $datas['productGroup']);
        }
        if($datas['serviceArea']){
            $datas['city_id'] = implode(",", $datas['serviceArea']);
        }
        if($datas['serviceGroup']){
            $datas['service_category'] = implode(",", $datas['serviceGroup']);
        }

        $datas["password"] = md5($datas["password"]);
        $datas["usertype"] = "4";
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
        $userid = $this->dbcon->Insert('itf_users',$datas);

        $maildatavalue = $this->GetEmail(3);
        $objmail = new ITFMailer();
        $objmail->SetSubject($maildatavalue['mailsubject']);
        $objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"emailid"=>$datas['email'],"password"=>$_POST['password']));
        $objmail->SetTo($datas['email']);
        $objmail->MailSend();
        return $userid;
	}
	
	function getProductGroups()
        {
            $sql="select * from itf_product_group where status = 1";
            
            return $this->dbcon->FetchAllResults($sql);
        }
        
        function getServiceArea()
        {
            $sql="select * from itf_service_area where status = 1";
            
            return $this->dbcon->FetchAllResults($sql);
        }
	

	function CheckEmailId($emailid)
	{
		$sql="select * from itf_users where email='".$emailid."'";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['email']) and !empty($datas['email']))
			return true;
		else
			return false;
	}
	
	
	function CheckPhoneNumber($phone)
	{
		$sql="select * from itf_user_profile where email_phone='".$phone."'";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['email_phone']) and !empty($datas['email_phone']))
			return true;
		else
			return false;
	}
	
	
	function GetInfoByEmailId($emailid)
	{
		$sql="select * from itf_users where username='".$emailid."' and usertype != 1";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['email']) and !empty($datas['email']))
			return $datas;
		else
			return $datas;
	}
        
        function GetInfoByUserName($emailid)
	{
		$sql="select * from itf_users where username='".$emailid."' and usertype != 1";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['username']) and !empty($datas['username']))
			return $datas;
		else
			return $datas;
	}

    function CheckEmail($emailid)
    {

        $sql="select * from itf_users where email='".$emailid."'";
        $datas= $this->dbcon->Query($sql);

        if(isset($datas['email']) and !empty($datas['email']))
            return $datas;
        else
            return $datas;
    }

	
	function userUniqueByUsername($username)
	{
		$sql="select * from itf_users where username='".$username."'";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['username']) and !empty($datas['username']))
			return "1";
		else
			return "0";
	}
	
      	function UserCheckUsername($username)
	{
		$sql="select * from itf_users where username='".$username."'";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['username']) and !empty($datas['username']))
			return "1";
		else
			return "0";
	}

	
	function NormalUserLogin($datainfo)
	{
		 $sql="select id,name,last_name,username,email from  itf_users where  (email='".$this->dbcon->EscapeString($datainfo['username'])."' or username = '".$this->dbcon->EscapeString($datainfo['username'])."')
		        and password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and status ='1'";
				
			
		if($DD=$this->dbcon->Query($sql))
		{
			return $DD;
		}
		else
			return '0';
	}
	
	
function ForgotPassword($useremail)
	{
		$userdetail = $this->CheckEmail($useremail);
		if(isset($userdetail['id']))
		{
			$newpass = "crease".substr(time(),-4);
			$datas = array('password'=>md5($newpass),'password2'=>$newpass);
			$condition = array('id'=>$userdetail['id']);
			unset($datas['id']);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			//$maildatavalue = $this->GetEmail(10);
			//$objmail=new ITFMailer();
//			$objmail->SetSubject($maildatavalue['mailsubject']);
//			$objmail->SetBody($maildatavalue['mailbody'],array('name'=>$userdetail['name'],'username'=>$userdetail['username'],"password"=>$newpass));
//            $objmail->SetTo($userdetail['email']);
//			$objmail->MailSend();

                $to = $userdetail['email'];
				$from = 'info@creaseart.com';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				//$headers .= "Cc: ".$emailadmin['email']. "\r\n";

				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Forgot Password Creaseart Customer';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="https://www.creaseart.com" style="color:#FFFFFF;"><img border="1" src="https://www.creaseart.com/template/default/images/logo.png" title="creaseart.com"></a></td>

						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$userdetail['name'].',</p>
						<p>Your new Log in details are as follows,</p>
						<p>Email id : '.$userdetail['email'].'</p>
						<p>Password : '.$newpass.'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with creaseart and find it a very useful buying tool.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />

						&nbsp;&nbsp;The Creaseart Team </strong></p>
						E  info@creaseart.com<br/>
						W  https://www.creaseart.com
						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://www.creaseart.com" style="color:#fff;">creaseart.com</a></td>
						</tr>
						</table>';
                $ok = @mail($to , $subject, $message, $headers); 
			return true;
		}
		else
			return false;

	}


function ForgotPasswordVendor($useremail)
	{
		$userdetail = $this->CheckEmail($useremail);
		if(isset($userdetail['id']))
		{
			$newpass = "crease".substr(time(),-4);
			$datas = array('password'=>md5($newpass),'password2'=>$newpass);
			$condition = array('id'=>$userdetail['id']);
			unset($datas['id']);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			//$maildatavalue = $this->GetEmail(10);
			//$objmail=new ITFMailer();
//			$objmail->SetSubject($maildatavalue['mailsubject']);
//			$objmail->SetBody($maildatavalue['mailbody'],array('name'=>$userdetail['name'],'username'=>$userdetail['username'],"password"=>$newpass));
//            $objmail->SetTo($userdetail['email']);
//			$objmail->MailSend();

                $to = $userdetail['email'];
				$from = 'info@creaseart.com';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				//$headers .= "Cc: ".$emailadmin['email']. "\r\n";

				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Forgot Password Creaseart';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://creaseart.com/" style="color:#FFFFFF;"><img border="1" src="http://creaseart.com/template/default/image/logo.png" title="creaseart.com"></a></td>

						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$userdetail['name'].',</p>
						<p>Your new Login are as follows,</p>
						<p>Email id : '.$userdetail['email'].'</p>
						<p>Password : '.$newpass.'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with creaseart and find it a very useful buying tool.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />

						&nbsp;&nbsp;The Creaseart Team </strong></p>
						E  info@creaseart.com<br/>
						W  http://creaseart.com
						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://creaseart.com/" style="color:#fff;">creaseart.com</a></td>
						</tr>
						</table>';
                $ok = @mail($to , $subject, $message, $headers); 
			return true;
		}
		else
			return false;

	}
	
	
	
    function showAllSuppliers($service_category)
    {
        if(isset($service_category)){
      
		//echo "select U.id as user_id,U.*,UNIX_TIMESTAMP(U.entrydate) as created_date,P.* from itf_users U
          //    LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=3 and FIND_IN_SET('".$service_category."',service_category) ";
		$sql="select U.id as user_id,U.*,UNIX_TIMESTAMP(U.entrydate) as created_date,P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=3 and FIND_IN_SET('".$service_category."',service_category) ";

            return $this->dbcon->FetchAllResults($sql);
        } else {

            return array();
        }

    }

    function addCategory($postdata)
    {
        //echo"<pre>"; print_r($postdata); die();
        $sql="select U.*,UP.product_group_id from itf_users U
              INNER JOIN itf_user_profile UP on UP.id = U.profile_id where U.id = '".$_SESSION['FRONTUSER']['id']."'  ";
        $res = $this->dbcon->Query($sql);
      
        $sql2="select id from itf_category where catname = '".$postdata['category']."'";
        $res2 = $this->dbcon->Query($sql2);
         
        $data = array('product_group_id'=>$res2['id'].','.$res['product_group_id']);
     
        $condition = array('id'=>$res['profile_id']);
        $this->dbcon->Modify('itf_user_profile',$data,$condition);
        
        $pgid = explode(",", $res['product_group_id']);
       
        if(!$res2['id']){return 1;}
        elseif (in_array($res2['id'], $pgid)) {return 2;}
        else{return 3;}

    }

    function removeCategory($postdata)
    {
        $sql="select U.*,UP.product_group_id from itf_users U
              INNER JOIN itf_user_profile UP on UP.id = U.profile_id where U.id = '".$_SESSION['FRONTUSER']['id']."'  ";
        $res = $this->dbcon->Query($sql);

        $cat = explode(',',$res['product_group_id']);
        foreach($cat as $key=>$category)
        {
            if($category == $postdata['id']){
                unset($cat[$key]);
            }
        }
        $data = array('product_group_id'=>implode(',',$cat));
        $condition = array('id'=>$res['profile_id']);
        $this->dbcon->Modify('itf_user_profile',$data,$condition);
    }

    function removeMoneyRequest($id)
    {
        $sql="delete from itf_money_request where id in(".$id.")";
        $this->dbcon->Query($sql);

        return $this->dbcon->querycounter;
    }
    
     function adminNotifMail($id)
    {
         $name=$_SESSION['FRONTUSER']['name'];
         $em=$_SESSION['FRONTUSER']['email'];
        
        $mailerdiv='<div class="cart_cont"><div class="suply">
            <table>
                <tr>
                    <th bgcolor="#666" style="text-align:center; padding:5px 20px; width:100px">Supplier ID</th>
                    <th bgcolor="#666" style="text-align:center; padding:5px 20px; width:100px">Quote Title</th>
                    <th bgcolor="#666" style="text-align:center; padding:5px 20px; width:100px">Bid Price</th>
                </tr>
            </table>
</div>
</div>';
        $totalgrand=0;
        foreach($id as $key=>$value)
        {
          
             $mailerdiv.='<div class="cart_cont"><div class="suply">
                 <table>
                    <tr>
                        <td  style="text-align:center; padding:5px 10px; width:100px">'.$value['supplier_id'].'</td>
                        <td style="text-align:center; padding:5px 10px; width:100px">'.$value['quote_name'].'</td>
                        <td style="text-align:center; padding:5px 10px; width:100px">'.$value['bid_amount'].'</td>
                    </tr>
                </table>
</div>
</div>';  
        $totalgrand += $value['bid_amount'];    
    
             
        }
         $mailerdiv.='<div class="cart_cont"><div class="suply">
<p> Grand Total : '.$totalgrand.' </p>
</div>
</div>'; 
          $admin_mail = $this->CheckUser(1);
           $email=$this->SelectMail();
              $adminemail= $email['email'];
              
             
          $maildatavalue = $this->GetEmail(13);
        $objmail=new ITFMailer();
	$objmail->SetSubject($maildatavalue['mailsubject']);
	$objmail->SetBody($maildatavalue['mailbody'],array( 'name'=>$name,'email'=>$em,'Productdetail'=>$mailerdiv));
        $objmail->SetTo($adminemail);
	$objmail->MailSend();
        
    }
    
    
	function getAllmemberPlan()
	{
		$sql="select *  from itf_membership where type='Buyers' and status=1";
		return $this->dbcon->FetchAllResults($sql);

	}
	
	
        function getAllmemberPlanSup()
	{
		$sql="select *  from itf_membership where type='Sellers' and status=1";
		return $this->dbcon->FetchAllResults($sql);

	}
        
        function getAllmemberPlanBoth()
	{
		$sql="select *  from itf_membership where type='Both' and status=1";
		return $this->dbcon->FetchAllResults($sql);

	}
        
        
        
        function getAmountPlan($id)
	{
		$sql="select *  from itf_membership where id=$id";
		return $this->dbcon->Query($sql);

	}
        
          function tempData($id)
	{
		$sql="select *  from itf_users_temp where id=$id";
		return $this->dbcon->Query($sql);

	}
         function getCheckPayMem($UsId)
	{
		 $sql="select *from itf_membership where id='".$UsId."'"; 
	 	return $this->dbcon->Query($sql);
	}
        
        function freeRegister($datas)
	{	    $datas['service_category'] = implode(',',$datas['service_category']);
        
         $datas['password2']= $datas['password'];
        $userinfo = $this->CheckMembership($datas['memberid']);
          $type=$userinfo['type'];
         $day=$userinfo['duration_day'];
         $durationtime=$userinfo['duration_type'];
        // $end = date('Y-m-d', strtotime('+'.$day .$durationtime));
        $admin_mail = $this->CheckUser(1);
        $objsite = new Site();
        $siteinfo = $objsite->CheckSite("1");
		
if(isset($_FILES['company_logo']['name']) and !empty($_FILES['company_logo']['name']))
		{
			$fimgname="vendor_company".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['company_logo']['tmp_name']);
			$objimage->save(PUBLICFILE."company_logo/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['company_logo']= $productimagename;
		}
		
		if(isset($_FILES['profile_image']['name']) and !empty($_FILES['profile_image']['name']))
		{
			$fimgname="vendor_profile".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['profile_image']['tmp_name']);
			$objimage->save(PUBLICFILE."profile/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['profile_image']= $productimagename;
		}

		
		
		unset($datas['id']);
		$datas["password"] = md5($datas["password"]);
                if($type=="Customers")
                {
					$end = date('Y-m-d', strtotime('+'.$day .$durationtime));
					
                   $datas["usertype"] = "2"; 
                  // $datas["registration_id"] = 'CACR'.time();
                    
                }
                elseif ($type=="Vendors") {
					$end = date('Y-m-d', strtotime('+7 days'));
                       $datas["usertype"] = "3"; 
                     //   $datas["registration_id"] = 'CAVR'.time();
                
                        }
						
				elseif ($type=="Riders") {
				$end = date('Y-m-d', strtotime('+7 days'));
				$datas["usertype"] = "5"; 
				//   $datas["registration_id"] = 'CAVR'.time();
				
				}

            else {
				$end = date('Y-m-d', strtotime('+7 days'));
                         $datas["usertype"] = "4";
                       //   $datas["registration_id"] = 'CAMR'.time();
                 }
		//$datas["usertype"] = "2";
               $datas["expiry_date"] =$end;
               //echo "<pre>";print_r($datas);die;
       
//        if($datas['payment_type']=="account"){
//            $datas['status'] = 0;
//            $maildatavalue = $this->GetEmail(12);
//            $objmail = new ITFMailer();
//            $objmail->SetSubject($maildatavalue['mailsubject']);
//            $objmail->SetBody($maildatavalue['mailbody'],array('name'=>$datas['name'],"emailid"=>$datas['email']));
//            $objmail->SetTo($admin_mail['email']);
//            $objmail->MailSend();
//        }
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
        // $emailadmin=$this->GetAdminEmail1();
//          $to = $emailadmin['email'].','.$datas['email'];
//		$maildatavalue = $this->GetEmail(2);
//		$objmail = new ITFMailer();
//		$objmail->SetSubject($maildatavalue['mailsubject']);
//		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
//		$objmail->SetTo($datas['email']);
//		$objmail->MailSend();
//		return $userid;
                 $emailadmin=$this->GetAdminEmail1();
		        $emailadmin1 = $emailadmin['email'];
			
				$to = $datas['email'];
				$from = 'info@creaseart.com';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				 if($type=="Buyers")
                {
				$subject = 'Registration on Perth Tango Society';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://creaseart.com" style="color:#FFFFFF;"><img border="1" src="http://creaseart.com/template/default/image/logo.png" title="creaseart"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$datas['name'].',</p>
						<p>Thanks for Registering as a Member on Perth Tango Society.</p>
						<p>Your logon details are as follows,</p>
						<p>Email id : '.$datas['email'].'</p>
						<p>Password : '.$datas['password2'].'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with Creaseart and find it a very useful buying tool.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Perth Tango Society Team </strong></p>
						E  info@creaseart.com<br/>
						W  http://creaseart.com

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://creaseart.com" style="color:#fff;">Perth Tango Society</a></td>
						</tr>
						</table>';
				}else{
					
				$subject = 'Member Registration on Creaseart';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://creaseart.com/" style="color:#FFFFFF;"><img border="1" src="http://creaseart.com/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$datas['name'].',</p>
						<p>Thanks for Registering as a Member on Creaseart. We are sure you will find this a very useful tool for your Business.</p>
						<p>Your logon details are as follows,</p>
						<p>Username : '.$datas['username'].'</p>
						<p>Password : '.$datas['password2'].'</p>
						<p>&nbsp;</p>
						<p>You have 7 days to complete your Registration, or you may wish to do so now by clicking on the Payment link below. If your Registration is not completed within the 7 days then you will need to register again.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Creaseart Team </strong></p>
						E  info@creaseart.com<br/>
						W  http://creaseart.com

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://creaseart.com" style="color:#fff;">Creaseart</a></td>
						</tr>
						</table>';
				}
				
				
						$ok = @mail($to , $subject, $message, $headers); 
						return $datas;
			
		
	}
       
	     
          
        function AdminCustomerRegister($datas) {
        $datas["password"] = md5($datas["password"]);
         $datas['password2']= $datas['password'];
        $admin_mail = $this->CheckUser(1);
               $datas["usertype"] = "2"; 
				unset($datas['id']);            
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
 
                 $emailadmin=$this->GetAdminEmail1();
		        $emailadmin1 = $emailadmin['email'];
			
				$to = $datas['email'];
				$from = 'info@perthtangosociety.com.au';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Registration on Perth Tango Society';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="https://perthtangosociety.com.au" style="color:#FFFFFF;">
                        <img border="1" src="https://perthtangosociety.com.au/template/default/image/logo.png" title="Perth Tango Society"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$datas['name'].',</p>
						<p>Thanks for Registering as a User on Perth Tango Society.</p>
						<p>Your logon details are as follows,</p>
						<p>Email id : '.$datas['email'].'</p>
						<p>Password : '.$datas['password2'].'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with Perth Tango Society and find it a very useful.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Perth Tango Society Team </strong></p>
						E  info@perthtangosociety.com.au<br/>
						W  https://perthtangosociety.com.au

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://perthtangosociety.com.au" style="color:#fff;">
                        Perth Tango Society</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
						return $datas;
			
		
	}
       
	     
     function AdminMemberRegister($datas) {
        $datas["password"] = md5($datas["password"]);
         $datas['password2']= $datas['password'];
        $admin_mail = $this->CheckUser(1);
               $datas["usertype"] = "3"; 
         
         
         if(isset($_FILES['company_logo']['name']) and !empty($_FILES['company_logo']['name']))
		{
			$fimgname="member_company".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['company_logo']['tmp_name']);
			$objimage->save(PUBLICFILE."company_logo/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['company_logo']= $productimagename;
		}
		
		if(isset($_FILES['profile_image']['name']) and !empty($_FILES['profile_image']['name']))
		{
			$fimgname="member_profile".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['profile_image']['tmp_name']);
			$objimage->save(PUBLICFILE."profile/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['profile_image']= $productimagename;
		}
				unset($datas['id']);            
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
 
                 $emailadmin=$this->GetAdminEmail1();
		        $emailadmin1 = $emailadmin['email'];
			
				$to = $datas['email'];
				$from = 'info@perthtangosociety.com.au';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Registration on Perth Tango Society';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="https://perthtangosociety.com.au" style="color:#FFFFFF;">
                        <img border="1" src="https://perthtangosociety.com.au/template/default/image/logo.png" title="Perth Tango Society"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$datas['name'].',</p>
						<p>Thanks for Registering as a Member on Perth Tango Society.</p>
						<p>Your logon details are as follows,</p>
						<p>Email id : '.$datas['email'].'</p>
						<p>Password : '.$datas['password2'].'</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with Perth Tango Society and find it a very useful.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Perth Tango Society Team </strong></p>
						E  info@perthtangosociety.com.au<br/>
						W  https://perthtangosociety.com.au

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="https://perthtangosociety.com.au" style="color:#fff;">
                        Perth Tango Society</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
						return $datas;
			
		
	}
    
	function GetAdminEmail1(){
	
			$sql="select * from itf_users  where usertype=1";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
	   
	   
	    function webservice_user_update($datas)
	{
                 				 
        $profile_info = $this->CheckProfile($datas['user_id']);
		
		$condition = array('id'=>$profile_info['id']);
	    $profile_condition = array('id'=>$datas['user_id']);
	
		unset($datas['user_id']);
       
        $datas['password2'] = $datas['password'];
		if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
			 
        }
		
	 $data = $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
     $data = $this->dbcon->Modify('itf_users',$datas,$condition);
	   
 return true;
	             
	}
	
		    function webservice_user_token_update($datas)
	{
                 				 
        $profile_info = $this->CheckProfile($datas['user_id']);
		
		$condition = array('profile_id'=>$profile_info['id']);
	    $profile_condition = array('id'=>$datas['user_id']);
	
		unset($datas['user_id']);
       
        $datas['password2'] = $datas['password'];
		if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
			 
        }
		
	 $data = $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
     $data = $this->dbcon->Modify('itf_users',$datas,$condition);
	   
 return true;
	             
	}
	
		    function webservice_vendor_token_update($datas)
	{
                 				 
        $profile_info = $this->CheckProfile($datas['vendor_id']);
		
		$condition = array('profile_id'=>$profile_info['id']);
	    $profile_condition = array('id'=>$datas['vendor_id']);
	
		unset($datas['vendor_id']);
       
        $datas['password2'] = $datas['password'];
		if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
			 
        }
		
	 $data = $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
     $data = $this->dbcon->Modify('itf_users',$datas,$condition);
	   
 return true;
	             
	}
	
	
			    function webservice_rider_token_update($datas)
	{
                 				 
        $profile_info = $this->CheckProfile($datas['rider_id']);
		
		$condition = array('profile_id'=>$profile_info['id']);
	    $profile_condition = array('id'=>$datas['rider_id']);
	
		unset($datas['rider_id']);
       
        $datas['password2'] = $datas['password'];
		if(empty($datas['password']))
        {
            unset($datas['password']);
        }else{
            $datas['password'] = md5($datas['password']);
			 
        }
		
	 $data = $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
     $data = $this->dbcon->Modify('itf_users',$datas,$condition);
	   
 return true;
	             
	}
	   
	   
  function admin_send_newsletter1($datas)
	{
			//echo "<pre>";print_r($datas); 
			$emailadmin=$this->GetAdminEmail1();
			
			//$from = $emailadmin['email']; 
			$emailids = $datas['email2'];
			$name = $datas['name'];
			$expiry_date = $datas['expiry_date'];
			// echo "<pre>";print_r($from);
			//$subject = 'Plucka Membership Expire Date';
//			$headers = "From: $from";
//			$message = "Hii $name, your membership expire date is $expiry_date";
//			
				$to = $datas['email2'];
				$from = $emailadmin['email'];
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: " . $from . "\r\n";
				$headers .= "Cc: ".$emailadmin['email']. "\r\n";
				//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Plucka Membership Expire Date';
				$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="1" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi '.$datas['name'].',</p>
						<p>Your Plucka membership expire date is  '.$expiry_date.'</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>We are sure that you will enjoy your experience with Plucka and find it a very useful buying tool.</p>
						<p>If you have any issues or queries at any time please send us an email or contact us by phone and we will respond accordingly.</p>
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Plucka Team </strong></p>
						P  1300 671 660 <br/>
						E  team@plucka.com.au<br/>
						W  http://plucka.co

						</td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://plucka.co/" style="color:#fff;">Plucka</a></td>
						</tr>
						</table>';
			$ok = @mail($to, $subject, $message, $headers); 
	 	return $datas;
	}
        
        
	   function excelUpload(){
        if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name']))
        {
            @unlink(PUBLICFILE."products/plucka_excel_products.xls");
            $fimgname="plucka_excel_products";
            $objimage= new ITFUpload();
            $objimage->load($_FILES['file']);
            $objimage->save(PUBLICFILE."products/".$fimgname);
            $productimagename = $objimage->createnames;

            return $productimagename;
        }
    }
	
	   function freeRegisterexcel($datas)
	{
         $datas['password2']=$datas['password'];
            //echo "<pre>";print_r($datas);die;
        $admin_mail = $this->CheckUser(1);
		unset($datas['id']);
        $datas["password"] = md5($datas["password"]);
		
        $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		//echo "<pre>";print_r($datas);die;
		$userid = $this->dbcon->Insert('itf_users',$datas);
		$maildatavalue = $this->GetEmail(2);
		$objmail = new ITFMailer();
		$objmail->SetSubject($maildatavalue['mailsubject']);
		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
		$objmail->SetTo($datas['email']);
		$objmail->MailSend();
		return $userid;
		
	}
       
function user_updateexcel($datas)
	{ 
        $userinfo = $this->CheckUser($datas['id']);
		 //print_r($userinfo); 
        $profile_info = $this->CheckProfile($userinfo['profile_id']);
		//print_r($profile_info); 
        $condition = array('id'=>$datas['id']);
        $profile_condition = array('id'=>$profile_info['id']);
        //unset($datas['id']);
//        if(empty($datas['password']))
//        {
//            unset($datas['password']);
//        }else{
//            $datas['password'] = md5($datas['password']);
//        }
     
        $this->dbcon->Modify('itf_users',$datas,$condition);
        $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
	}
	
	function NormalUserLoginAPI($datainfo)
	{
	$sql="select U.id as user_id, U.email as email_id, U.*,P.profile_image,P.country_code,P.id from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              where (U.email='".$this->dbcon->EscapeString($datainfo['email'])."' or U.username = '".$this->dbcon->EscapeString($datainfo['email'])."')
		        and U.password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and U.status ='1'";
				
		//$sql="select id,name,last_name,username,email,profile_id from  itf_users where  (email='".$this->dbcon->EscapeString($datainfo['email'])."' or username = '".$this->dbcon->EscapeString($datainfo['username'])."')
		  //      and password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and status ='1'";
				
			
		if($DD=$this->dbcon->Query($sql))
		{
			return $DD;
		}
		else
			return '0';
	}
	
	
		function VendorUserLoginAPI($datainfo)
	{
	$sql="select U.id as user_id, U.email as email_id, U.*,P.*  from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              where (U.email='".$this->dbcon->EscapeString($datainfo['email'])."' or U.username = '".$this->dbcon->EscapeString($datainfo['email'])."')
		        and U.password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and U.status ='1' and U.usertype='3' ";
				
		//$sql="select id,name,last_name,username,email,profile_id from  itf_users where  (email='".$this->dbcon->EscapeString($datainfo['email'])."' or username = '".$this->dbcon->EscapeString($datainfo['username'])."')
		  //      and password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and status ='1'";
				
			
		if($DD=$this->dbcon->Query($sql))
		{
			return $DD;
		}
		else
			return '0';
	}
	
	
	
		function RiderUserLoginAPI($datainfo)
	{
	$sql="select U.id as user_id, U.email as email_id, U.*,P.*  from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              where (P.email_phone='".$this->dbcon->EscapeString($datainfo['phone'])."' or U.username = '".$this->dbcon->EscapeString($datainfo['phone'])."')
		        and U.password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and U.status ='1' and U.usertype='5' ";
				
		//$sql="select id,name,last_name,username,email,profile_id from  itf_users where  (email='".$this->dbcon->EscapeString($datainfo['email'])."' or username = '".$this->dbcon->EscapeString($datainfo['username'])."')
		  //      and password='".md5($this->dbcon->EscapeString($datainfo['password']))."' and status ='1'";
				
			
		if($DD=$this->dbcon->Query($sql))
		{
			return $DD;
		}
		else
			return '0';
	}
	
	
	
	    function webservice_user_add($datas)
        {
             $datas['password']=md5($datas['pass']);
            $datas['password2']=$datas['pass'];
            $datas['username']=$datas['email'];
            $datas['usertype']=2;
            
	  	unset($datas['id']);
		 $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
		
		$maildatavalue = $this->GetEmail(2);
		$objmail = new ITFMailer();
		$objmail->SetSubject($maildatavalue['mailsubject']);
		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
		$objmail->SetTo($datas['email']);
		$objmail->MailSend();
		//return $userid;            
	}
	
	
		function userAppProfile($uname)
	{
  $sql="select U.*,U.id as user_id,P.* from itf_users U
          INNER JOIN itf_user_profile P on U.profile_id = P.id AND U.email=P.email
          where U.profile_id='".$uname."'";	  			  
		if( $pd=$this->dbcon->Query($sql))                 
		{
		       return $pd;
		}
  }	
  
  
  function VendorAppProfile($uname)
	{
$sql="select U.*,U.id as user_id,P.*,V.* from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id AND U.email=P.email
		  LEFT JOIN itf_vendor_rating V on U.profile_id = V.vendid
          where U.profile_id='".$uname."' and U.usertype='3'";	  			  
		if( $pd=$this->dbcon->Query($sql))                 
		{
		       return $pd;
		}
		
  }	
  
    function VendorListAppProfileByLocationlatnlog($origLat,$origLon)
    {
       
	 /*$sql="select U.id as user_id,U.*, P.*, R.* from itf_users U
                 LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			    LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
			  where U.usertype=3 and U.status=1";
     */
	 $dist =3;
	  $sql = "select U.id as user_id,U.*, P.*, R.*, 6371 * 2 * ASIN(SQRT(POWER(SIN(($origLat - P.lat)*pi()/180/2),2) +COS($origLat*pi()/180 )*COS(P.lat*pi()/180) *POWER(SIN(($origLon-P.longi)*pi()/180/2),2))) as distance from itf_users U LEFT JOIN itf_user_profile P ON U.profile_id = P.id LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid where U.usertype=3 and U.status=1 and P.longi between ($origLon-$dist/cos(radians($origLat))*69) 
          and ($origLon+$dist/cos(radians($origLat))*69) 
          and P.lat between ($origLat-($dist/69)) 
          and ($origLat+($dist/69)) 
          having distance <= $dist ORDER BY distance limit 100";   
	 return $this->dbcon->FetchAllResults($sql);

    }
	
  
  function VendorListAppProfileByLocation($origLat, $origLon, $pincode, $catid)
    {
     $dist =3;
			 $sql = "(select U.id as user_id,U.*, P.*, R.*,C.id, 6371 * 2 * ASIN(SQRT(POWER(SIN(($origLat - P.lat)*pi()/180/2),2) +COS($origLat*pi()/180 )*COS(P.lat*pi()/180) 
			*POWER(SIN(($origLon-P.longi)*pi()/180/2),2))) as distance from 
			itf_users U LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
			LEFT JOIN itf_category C ON P.service_category = C.id 
			where U.usertype=3 and U.status=1 and P.longi between ($origLon-$dist/cos(radians($origLat))*69) 
			and ($origLon+$dist/cos(radians($origLat))*69) 
			and P.lat between ($origLat-($dist/69)) 
			and ($origLat+($dist/69)) 
			and FIND_IN_SET(".$catid.",P.service_category)
			having distance <= $dist ORDER BY distance limit 100) UNION ALL 
			
			(select U.id as user_id,U.*, P.*, R.*,C.id, NUll as distance from itf_users U
			LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
			LEFT JOIN itf_category C ON P.service_category = C.id 
			where U.usertype=3 and P.postal_code='".$pincode."' and FIND_IN_SET(".$catid.",P.service_category) and U.status=1)";   
			return $this->dbcon->FetchAllResults($sql);

    }
	
	 function VendorListAppProfileByPincode($pincode, $catid)
    {
       
	 $sql="select U.id as user_id,U.*, P.*, R.*,C.* from itf_users U
                 LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			    LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
				LEFT JOIN itf_category C ON P.service_category = C.id 
				
			  where U.usertype=3 and P.postal_code='".$pincode."' and FIND_IN_SET(".$catid.",P.service_category) and U.status=1";


	 return $this->dbcon->FetchAllResults($sql);

    }
	
	
	function VendorListAppProfile()
    {
       
	 $sql="select U.id as user_id,U.*, P.*, R.* from itf_users U
                 LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			    LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
			  where U.usertype=3 and U.status=1";
     
	  
	 return $this->dbcon->FetchAllResults($sql);

    }
	
    	function CheckProfileID($id)
	{
        $sql="select * from itf_users where profile_id='".$id."'";
		$datas= $this->dbcon->Query($sql);
		if(isset($datas['id']) and !empty($datas['id']))
			return true;
		else
			return false;
	}
	
	    function webservice_user_address_add($datas)
        {
	  $datas["usersid"] = $datas["user_id"];
		$datas["address"] = $datas["address_name"]; 
		 $profileid = $this->dbcon->Insert('itf_user_address',$datas);
		return $profileid;            
	}
		
		function webservice_user_address_update($datas){
        $condition = array('id'=>$datas['id']);
        unset($datas['id']);

        $this->dbcon->Modify('itf_user_address',$datas,$condition);
    }

	
	
	function user_address_delete($datas)
	{
		
      $sql="delete from itf_user_address where usersid='".$datas['user_id']."' and id='".$datas['id']."'";
        $this->dbcon->Query($sql);
        return $this->dbcon->querycounter;;
	}
	
	
		function ShowUserAddress($usid)
    {
	 $sql="select * from itf_user_address where usersid='".$usid."'";
	 return $this->dbcon->FetchAllResults($sql);

    }


	    function webservice_user_feedback_add($datas)
        {
			
	  $datas["users_id"] = $datas["user_id"];
		$datas["feedback"] = $datas["message"]; 
		 $profileid = $this->dbcon->Insert('itf_feedback',$datas);
		return $profileid;            
	}
	
	    function VendorProductDetails($profid, $catid)
    {
       
	 $sql="select U.id as user_id,U.*, P.*, R.*,V.* from itf_users U
                 LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
			    LEFT JOIN itf_vendor_rating R ON U.profile_id = R.vendid 
				 LEFT JOIN itf_product V ON U.profile_id = V.seller_id 
			  where U.usertype=3 and U.status=1 and U.profile_id='".$profid."' and V.category_id='".$catid."'";
        return $this->dbcon->FetchAllResults($sql);

    }


  function VendorProductDetailsNew($profid, $catid)
    {
		
		
       
	  $sql="select U.id as user_id,U.*, P.*, V.id as Pro_id, V.* from itf_users U
                 LEFT JOIN itf_user_profile P ON U.profile_id = P.id 
				 LEFT JOIN itf_product V ON U.profile_id = V.seller_id 
			  where U.usertype=3 and U.status=1 and U.profile_id='".$profid."' and V.category_id='".$catid."' group by V.subcat_id";
        return $this->dbcon->FetchAllResults($sql);

    }

    function VendorProductDetailsNew2($profid,$subcatid)
    {
       
	 $sql = "select * from itf_product where subcat_id='".$subcatid."' and seller_id='".$profid."' ";
        return $this->dbcon->FetchAllResults($sql);

    }
	
	
	 function getRiderInfoByProfileId($UsId)
    {
        
       // echo "<pre>";print_r($UsId);die;
   $sql="select U.id as user_id,U.*, P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              where P.id='".$UsId."' and U.usertype=5 ";
        return $this->dbcon->Query($sql);
    }
	
	 function getUserInfoByProfileId($UsId)
    {
        
        //echo "<pre>";print_r($UsId);die;
       $sql="select U.id as user_id,U.*,UNIX_TIMESTAMP(U.entrydate) as created_date,P.*,C.country_name from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id
              LEFT JOIN itf_country C ON C.country_code = P.country_code
              where P.id='".$UsId."' ";
        return $this->dbcon->Query($sql);
    }
       public function User_Profile_Image_Upload($datas)
			{
				
				
				if(isset($_FILES['profile_image']['name']) and !empty($_FILES['profile_image']['name']))
		{
			$fimgname="user_profile".time();
			$objimage= new ITFUpload();
			$objimage->load($_FILES['profile_image']);
			//echo PUBLICFILE; die;
			$objimage->save(PUBLICFILE."profile/".$fimgname);
			$resumename=$objimage->GetFilename();
			$datas['profile_image']=$resumename;
		}else {
			
			return 0;
			}
		
		$condition = array('id'=>$datas['user_id']);
			unset($datas['id']);
			
		return $this->dbcon->Modify('itf_user_profile',$datas,	$condition);
			}
			
			
			function RiderUserAdd($datas)
        {
			$datas['password2'] = $datas['password'];
             $datas['password']= md5($datas['password']);
            $datas['username']=$datas['email_phone'];
			$datas['email_phone']=$datas['phone'];
			$datas['rider_vehicle']=$datas['vehicleno'];
            $datas['usertype']=5;
            
	  	unset($datas['id']);
		 $profileid = $this->dbcon->Insert('itf_user_profile',$datas);
        $datas["profile_id"] = $profileid;
		$userid = $this->dbcon->Insert('itf_users',$datas);
		
		$maildatavalue = $this->GetEmail(20);
		$objmail = new ITFMailer();
		$objmail->SetSubject($maildatavalue['mailsubject']);
		$objmail->SetBody($maildatavalue['mailbody'],array('sitename'=>$siteinfo['sitename'],'name'=>$datas['name'],"username"=>$datas['username'],"emailid"=>$datas['username'],"password"=>$datas['password2']));
		$objmail->SetTo($datas['email']);
		$objmail->MailSend();
		//return $userid;            
	}
	
	
	function RiderAPPProfile($vendor_id)
	{
 $sql="select U.*,U.id as user_id,P.* from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id 
          where P.vendor_id='".$vendor_id."'";	  	
		 return $this->dbcon->FetchAllResults($sql);
  }	
  
  
    function RiderAppProfileDetail($vendor_id, $rider_id)
	{
$sql="select U.*,U.id as user_id,P.* from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id 
          where U.profile_id='".$rider_id."' and P.vendor_id='".$vendor_id."'";	  			  
		if( $pd=$this->dbcon->Query($sql))                 
		{
		       return $pd;
		}
  }	
  
  
  function RiderProfileUpdate($datas)
	{
       	$datas['rider_vehicle']=$datas['vehicleno'];
		if(empty($datas['pass']))
        {
            unset($datas['pass']);
        }else{
            $datas['password'] = md5($datas['pass']);
			$datas['password2'] = $datas['pass'];
        }
        	 
        $profile_info = $this->CheckProfile($datas['rider_id']);		
		$condition = array('profile_id'=>$profile_info['id']);
	    $profile_condition = array('id'=>$datas['rider_id']);
		unset($datas['rider_id']);
		
	    $data = $this->dbcon->Modify('itf_user_profile',$datas,$profile_condition);
        $data = $this->dbcon->Modify('itf_users',$datas,$condition);
	   
     return true;
	             
	}
	
		
		function ChangeUserPassword($user_id,$data)
	        {
				$data=$_REQUEST;
				
			$datas=array('password'=>md5($data["password"]),'password2'=>$data["password"]);
			$condition = array('profile_id'=>$user_id);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			return true;
	        }
  
  
       function ChangeVendorPassword($vendor_id,$data)
	        {
				$data=$_REQUEST;
				
			$datas=array('password'=>md5($data["password"]),'password2'=>$data["password"]);
			$condition = array('profile_id'=>$vendor_id);
			$this->dbcon->Modify('itf_users',$datas,$condition);
			return true;
	        }
  
  
	 function CheckOrderStatusByid($order_id)
	      {
          $sql="select * from itf_order where id='".$order_id."'";	  
		 return $this->dbcon->Query($sql);	
	 
	      }
		  
		  function CheckRatingByOrderId($order_id)
	      {
          $sql="select * from itf_vendor_rating where ordid='".$order_id."'";	  
		 return $this->dbcon->Query($sql);	
	 
	      }
		  
		  
	    function UserRatingVendorAdd($datas)
        {
			$orrd = $this->CheckOrderStatusByid($datas["order_id"]);
			
	       $datas["usid"] = $orrd["usid"];
	    $datas["vendid"] = $orrd["vendor_id"];
		$datas["ordid"] = $datas["order_id"];
		 $profileid = $this->dbcon->Insert('itf_vendor_rating',$datas);
		return $profileid;            
	}
		
  
}
?>
