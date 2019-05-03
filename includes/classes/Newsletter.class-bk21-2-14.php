<?php
class Newsletter
{

	public $dbcon;
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}
	//Add Data	
	function admin_add($datas)
	{
		$this->dbcon->Insert(' itf_newsletter',$datas);
	}
	
	//Delete Data
	function admin_delete($UId)
	{
		$sql="delete from  itf_newsletter where id in(".$UId.")";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}

        function admin_subscriber_delete($UId)
        {
            $sql="delete from  itf_subscriber where id in(".$UId.")";
            $this->dbcon->Query($sql);
            return $this->dbcon->querycounter;
        }
        

	//Update Data

	function admin_update($datas)
	{
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify(' itf_newsletter',$datas,$condition);
	}


	function ShowAllNewsletter()
	{
		$sql="select * from  itf_newsletter";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}

    function ShowAllSubscribers()
    {
        $sql="select * from itf_subscriber";
        $datas=$this->dbcon->FetchAllResults($sql);
        return $datas;
    }

    function ShowAllSubscribersActive()
    {
        $sql="select * from itf_subscriber where status=1";
        $datas=$this->dbcon->FetchAllResults($sql);
        return $datas;
    }


	function GetPageData($id)
	{
		$sql="select * from  itf_newsletter  where id='".$id."'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}

	function CheckNewsletter($UsId)
	{
		$sql="select * from  itf_newsletter where id='".$UsId."'";
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
		$this->dbcon->Modify(' itf_newsletter',$datas,$condition);
		return ($infos['status']=='1')?"0":"1";
	}
        
        // Front Functions
        
        function add_member($email)
	{
            $datas = array('email'=>trim(strtolower($email))); 
            $this->dbcon->Insert(' itf_subscriber',$datas);
	}
        
        
        
        function checkSubscriber($email)
        {
            $sql="select * from  itf_subscriber where email='".trim($email)."'";
            
            $res = $this->dbcon->Query($sql);
            
            if($res){ 
                
                return false;            
            } else{
                
                return true;
            }
        }
        
        
	function ShowAllNewsletterSend($id)
	{
		$sql="select * from  itf_newsletter where id='$id'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}
        
         function GetAdminEmail(){
         
            $sql="select * from itf_users  where usertype=1";
            $datas=$this->dbcon->Query($sql);
	 	return $datas;
        }
        
          function admin_send_newsletter($datas)
	{
             
             //echo "<pre>";print_r($datas);die;
           $emailadmin=$this->GetAdminEmail();
           
           $mess=$this->ShowAllNewsletterSend($id);
           $message=$mess['message'];
           
              //echo "<pre>";print_r($datas);die;
            $from = $emailadmin['email'];
            // echo "<pre>";print_r($from);die;
            //$subject = $datas['title'];
           // $message = $datas['description'];
             $emailids = $datas[select2];
      
//             $fileatt = $_FILES['pdf']['tmp_name'];
//            $fileatt_type = $_FILES['pdf']['type'];
//            $fileatt_name = $_FILES['pdf']['name'];

            $headers = "From: $from";



            foreach($emailids as $email)
            {
                
               
               //$message = SITEURL."/index.php?itfpage=unsubscribe&email=".$email."\n\n";
               
//                if (is_uploaded_file($fileatt)) {
//                // Read the file to be attached ('rb' = read binary)
//                $file = fopen($fileatt,'rb');
//                $data = fread($file,filesize($fileatt));
//                fclose($file);
            
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                // Add the headers for a file attachment
                $headers .= "\nMIME-Version: 1.0\n" .
                "Content-Type: multipart/mixed;\n" .
                " boundary=\"{$mime_boundary}\"";

                // Add a multipart boundary above the plain message
                $message .= "This is a multi-part message in MIME format.\n\n" .
                "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" .
                $message . "\n\n";
                //echo "<pre>";print_r($message);die;

                // Base64 encode the file data
                $data = chunk_split(base64_encode($data));

                // Add file attachment to the message
                $message .= "--{$mime_boundary}\n" .
                "Content-Type: {$fileatt_type};\n" .
                " name=\"{$fileatt_name}\"\n" .
                //"Content-Disposition: attachment;\n" .
                //" filename=\"{$fileatt_name}\"\n" .
                "Content-Transfer-Encoding: base64\n\n" .
                $data . "\n\n" .
                "--{$mime_boundary}--\n";
               
                //echo "<pre>";print_r($message);die;
               $ok = @mail($email, $subject, $message, $headers);
             

            }

		
	 	return $datas;
	}
        
        
        
}
?>