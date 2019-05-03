<?php
class State 
{
	
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}
		
	function admin_addState($datas)
	{
		unset($datas['id']);
		$this->dbcon->Insert('itf_state',$datas);
	}

	function admin_updateState($datas)
	{
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_state',$datas,$condition);
	}

	

	function State_deleteAdmin($Id)
	{
		$sql="delete from itf_state where id in(".$Id.")";	
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}
	
	function showAllState($parentid="0")
	{
		$sql="select S.*,(select count(*) from itf_state where parentid=S.id) as totalcity from itf_state S where S.parentid='".$parentid."' ";
		return $this->dbcon->FetchAllResults($sql);
	}
	


	function ShowAllStateSearch($txtsearch)
	{
		$sql="select * from itf_state where  name like ( '%".$this->dbcon->EscapeString($txtsearch)."%')";
		return $this->dbcon->FetchAllResults($sql);
	}
	
	function CheckState($UsId)
	{
		$sql="select U.* from itf_state U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
		
		
			
	function CheckStateName($UsId)
	{
		$sql="select U.* from itf_state U where U.name='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
			
	
	//Function for change status	
	function PublishBlock($ids)
	{	

		$infos=$this->CheckState($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_state',$datas,$condition);
		
		return ($infos['status']=='1')?"0":"1";

	}

	//front end============================================================
	function getAllStateFront($parentid="0")
	{
		$sql="select *  from itf_state where status='1' and parentid='".$parentid."' order by name ";
		return $this->dbcon->FetchAllResults($sql);
	}
	
		function getAllCityFront($parentid)
	{
		$sql="select *  from itf_state where status='1' and parentid='".$parentid."' order by name ";
		return $this->dbcon->FetchAllResults($sql);
	}
	
	
		function getAllLocationAds($parentid="0")
	{
		$sql="select *  from itf_state where status='1' and parentid='".$parentid."' order by name ";
		return $this->dbcon->FetchAllResults($sql);
	}
	
	
	function getAllStateCity()
	{
		$allstate=$this->showAllState(0);
		foreach($allstate as &$citystate)
			$citystate["CITY"]=$this->showAllState($citystate["id"]);
		return $allstate;
	}
	
	
	
	
}
?>