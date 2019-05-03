<?php
class Discount 
{
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}
	

	function adminAdd($datas)
	{
		unset($datas['id']);
		$this->dbcon->Insert('itf_discount',$datas);

	}

	function adminUpdate($datas)
	{
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_discount',$datas,$condition);
	}

	function adminDelete($Id)
	{
		$sql="delete from itf_discount where id in(".$Id.")";	
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}
	
	function showAll()
	{
		$sql="select * from itf_discount order by id desc";
		return $this->dbcon->FetchAllResults($sql);
	}
	function showAllDiscountFront()
	{
		$sql="select * from itf_discount where status='1' order by id desc ";
		return $this->dbcon->FetchAllResults($sql);
	}
	
	function getActiveData()
	{
		$sql="select * from itf_discount where status='1' order by discount_price asc";
		return $this->dbcon->FetchAllResults($sql);
	}

	function searchAll($txtsearch)
	{
		$sql="select * from itf_discount where  title like ( '%".$this->dbcon->EscapeString($txtsearch)."%')";
		return $this->dbcon->FetchAllResults($sql);
	}
	
	function checkData($UsId)
	{
		$sql="select U.* from itf_discount U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
			
	
	//Function for change status	
	function PublishBlock($ids)
	{	

		$infos=$this->checkData($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_discount',$datas,$condition);
		
		return ($infos['status']=='1')?"0":"1";

	}

	//front end============================================================
	
         function getActiveDepartment($facultyid)
	{
		$sql="select id,title from itf_discount where  status='1' and faculty_id='".$facultyid."' order by title asc";
		return $this->dbcon->FetchAllResults($sql);
	}
       
	   	
	function GetCouponDetail($UsId)
	{
	 $sql="select U.* from itf_discount U where U.discount_code='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
	
	
		function GetStatusDetail($UsId)
	{
	 $sql="select U.* from itf_order_status U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
	
	function showAllStatusFront()
	{
		$sql="select * from itf_order_status order by id asc ";
		return $this->dbcon->FetchAllResults($sql);
	}
	function showAllPayModeFront()
	{
		$sql="select * from itf_payment_mode_status order by id asc ";
		return $this->dbcon->FetchAllResults($sql);
	}
	function ShowPaymentmodebyid($UsId)
	{
		 $sql="select U.* from itf_payment_mode_status U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
		
	}
	
	function showStatusByStatusId($statusid)
	{
	   $sql="select U.* from itf_order_status U where U.id='".$statusid."'";
	 	return $this->dbcon->Query($sql);
	}
	
	
			
	
			 function CheckOrderStatusByid($order_id)
	{
 $sql="select * from itf_order where id='".$order_id."'";	  
		return $this->dbcon->Query($sql);	
	
	}
	
		function showAllStatusByOrderId($ordeid)
	{
	  $sql="select U.*,U.id as order_staus_id ,P.* from itf_app_order_status U
          LEFT JOIN itf_order_status P on U.status_id = P.status_ids 
          where U.order_ids='".$ordeid."'";	  	
		return $this->dbcon->FetchAllResults($sql);
	}
			
	
	function AddRiderStatus($datas)
	{
		
		 $datas['users_ids'] = $datas['user_id'];
		 $datas['vendors_ids'] = $datas['vendor_id'];
		 $datas['rider_ids'] = $datas['rider_id'];
		 $datas['order_ids'] = $datas['order_id'];
		 $datas['status_ids'] = $datas['status_id'];
		unset($datas['id']);
		$this->dbcon->Insert('itf_rider_order_status',$datas);

	}
	
	function AddRiderStatusNew($datas)
	{    
	/*print_r($datas);*/
	 $vendorid = $this->CheckOrderStatusByid($datas["order_id"]);	
		 $datas['users_id'] = $vendorid["usid"];
		 $datas['vendors_id'] =  $vendorid["vendor_id"];
		 $datas['rider_id'] = $datas['rider_id'];
		 $datas['status_id'] = $datas['status_id'];
		 $datas['order_ids'] = $datas['order_id'];
		unset($datas['id']);
		 
		$this->dbcon->Insert('itf_app_order_status',$datas);

	}
	
	
	function AddVendorOrderStatus($datas)
	{
		$vendorid = $this->CheckOrderStatusByid($datas["order_id"]);
		 $datas['vendors_id'] = $datas['vendor_id'];
		 $datas['order_ids'] = $datas['order_id'];
		 $datas['status_id'] = $datas['status_id'];
		 $datas['users_id'] = $vendorid["usid"];
		unset($datas['id']);
		$this->dbcon->Insert('itf_app_order_status',$datas);

	}
	
	function AddOrderStatusByUser($datas)
	{
		$vendorid = $this->CheckOrderStatusByid($datas["order_id"]);
		 $datas['vendors_id'] = $vendorid['vendor_id'];
		 $datas['order_ids'] = $datas['order_id'];
		 $datas['status_id'] = $datas['status_id'];
		 $datas['users_id'] = $vendorid["usid"];
		unset($datas['id']);
		$this->dbcon->Insert('itf_app_order_status',$datas);

	}
	
	
	
		function ShowRiderStatus($rider_id,$order_id,$status_id)
	{
          $sql="select * from itf_rider_order_status where rider_ids='".$rider_id."' and order_ids='".$order_id."' and status_ids='".$status_id."' ";	  	
			return $this->dbcon->Query($sql);
	}
	
		function ShowRiderStatusNew($rider_id,$order_id,$status_id)
	{
          $sql="select * from itf_app_order_status where rider_id='".$rider_id."' and order_ids='".$order_id."' and status_id='".$status_id."' ";	  	
			return $this->dbcon->Query($sql);
	}
	
	function ShowUserStatusNew($order_id,$status_id)
	{
           $sql="select * from itf_app_order_status where order_ids='".$order_id."' and status_id='".$status_id."' ";	  	
			return $this->dbcon->Query($sql);
	}
	
		function ShowAllRiderStatusByOrderid($order_id)
	{
       $sql="select * from itf_rider_order_status where order_ids='".$order_id."' order by id asc";	  	
			return $this->dbcon->FetchAllResults($sql);
	}


	function ShowVendorOrderStatus($vendor,$order_id,$status_id)
	{
          $sql="select * from itf_app_order_status where vendors_id='".$vendor."' and order_ids='".$order_id."' and status_id='".$status_id."' ";	  	
			return $this->dbcon->Query($sql);
	}
	
	
		function ShowAllVendorStatusByOrderid($order_id)
	{
       $sql="select * from itf_app_order_status where order_ids='".$order_id."' order by id asc";	  	
			return $this->dbcon->FetchAllResults($sql);
	}
	
	
		function ShowAllVendorStatusByOrderDetail($order_id)
	{
       $sql="select * from itf_rider_order_status where order_ids='".$order_id."' order by id asc";	  	
			return $this->dbcon->FetchAllResults($sql);
	}

	






}
?>