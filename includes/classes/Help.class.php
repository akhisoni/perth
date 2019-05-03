<?php
class Help 
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
		
		//$datas["name"]=empty($datas["name"])?Html::seoUrl($datas["pagetitle"]):Html::seoUrl($datas["name"]);
		unset($datas['id']);
		$this->dbcon->Insert('itf_help',$datas);
	}
	
	//Delete sports
	function admin_delete($UId)
	{
		$sql="delete from itf_help where id in(".$UId.")";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}

	
	//Update sports


	function admin_update($datas)
	{
		$condition = array('id'=>$datas['id']);
		//$datas["name"]=Html::seoUrl($datas["name"]);
		unset($datas['id']);
		$this->dbcon->Modify('itf_help',$datas,$condition);
	}


	function ShowAllHelp()
	{
		$sql="select * from itf_help";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
	function GetHelpData($id)
	{
		$sql="select * from itf_help  where id='".$id."'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}

	function CheckHelp($UsId)
	{
		$sql="select * from itf_help where id='".$UsId."'";
		return $this->dbcon->Query($sql);
	}

	

	function PublishBlock($ids)
	{	
		$infos=$this->CheckHelp($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_help',$datas,$condition);
		return ($infos['status']=='1')?"0":"1";
	}

	function GetArticales($pagename)
	{
		$sql="select * from itf_help where name='".$pagename."'";
		return $this->dbcon->Query($sql);
	}

	function GetMenuCms()
	{
		$sql="select id,name,pagetitle from itf_help order by id";
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
	
		function ShowAllHelpFront()
	{
		$sql="select * from itf_help where status=1";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	

}
?>