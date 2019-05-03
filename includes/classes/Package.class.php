<?php
class Package 
{

	public $dbcon;
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}
	function admin_add($datas)
	{
		$this->dbcon->Insert('itf_package',$datas);
	}
	
	//Delete sports
	function admin_delete($UId)
	{
		$sql="delete from itf_package where id in(".$UId.")";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}

	
	//Update sports


	function admin_update($datas)
	{
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_package',$datas,$condition);
	}


	function ShowAllPackage()
	{
		$sql="select * from itf_package";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
	function GetPackageData($id)
	{
		$sql="select * from itf_package  where id='".$id."'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}

	function CheckPackage($UsId)
	{
		$sql="select * from itf_package where id='".$UsId."'";
		return $this->dbcon->Query($sql);
	}

	

	function PublishBlock($ids)
	{	
		$infos=$this->CheckPackage($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_package',$datas,$condition);
		return ($infos['status']=='1')?"0":"1";
	}

	function GetArticales($package_name)
	{
		$sql="select * from itf_package where package_name='".CreatePage($package_name,"N")."'";
		return $this->dbcon->Query($sql);
	}

	function GetMenuCms()
	{
		$sql="select id,package_name from itf_package order by id";
		$res=$this->dbcon->FetchAllResults($sql);
		$menudata=array();
		foreach($res as $dd)
		$menudata[$dd["id"]]=$dd["package_name"];
		
		return $menudata;
	}
	
	
	#################### Front end use function ###########################
		function ShowAllPackageFront()
		{
		$sql="select * from itf_package where status=1";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
		}
		
		function ShowAllPackageFrontUnique($id)
		{
			$sql="select * from itf_package where id='".$id."' and status=1";
			return $this->dbcon->Query($sql);
		}
		
		function GetAllPackageCountFrontUnique($id)
		{
			$sql="select sum(noofjob) as totaljobpost from itf_user_payment where employ_id='".$id."'";
			return $this->dbcon->Query($sql);
		}
		
		
		function GetAllUsedPackageCountFrontUnique($id)
		{
			$sql="select count(*) as noofpost from itf_adjobplan  where employ_id='".$id."'";
			return $this->dbcon->Query($sql);
		}
		
		function PaymentPlanPostAd($serLisValue,$ProValue,$userid,$planid,$planname,$httpParsedResponseAr,$first_name,$last_name,$email,$planduration,$paymentType,$session_id)
		 {
			   $plan_duration= date('Y-m-d h:i:s', strtotime("+".$planduration, strtotime(date("Y-m-d h:i:s"))));
			
$dpayment = array('order_id'=>$session_id,'payer_id'=>$userid,'txn_id'=>$ProValue['TRANSACTIONID'],'txn_type'=>$paymentType,'payment_amount'=>$ProValue['AMT'],'package_id'=>$planid,'package_name'=>$planname,'all_details_paymeny'=>$serLisValue,'payment_status'=>'SUCCESS','first_name'=>$first_name,'last_name'=>$last_name,'payer_id'=>$userid,'payer_email'=>$email,'mc_currency'=>$ProValue['CURRENCYCODE'],'exp_date'=>$plan_duration,'plan_duration'=>$planduration,'premium'=>'0');
			
		
         $dd = $this->dbcon->Insert('itf_payment',$dpayment);
         return "1";
	    }
		
		
	   function PaymentPlanCaptainFront($serLisValue,$ProValue,$userid,$planid,$planname,$httpParsedResponseAr,$first_name,$last_name,$email,$planduration,$paymentType)
		 {
			   $plan_duration= date('Y-m-d h:i:s', strtotime("+".$planduration, strtotime(date("Y-m-d h:i:s"))));
			$dpayment = array('payer_id'=>$userid,'txn_id'=>$ProValue['TRANSACTIONID'],'txn_type'=>$paymentType,'payment_amount'=>$ProValue['AMT'],'plan_id'=>$planid,'plan_name'=>$planname,'all_details_paymeny'=>$serLisValue,'payment_status'=>'SUCCESS','first_name'=>$first_name,'last_name'=>$last_name,'payer_id'=>$userid,'payer_email'=>$email,'mc_currency'=>$ProValue['CURRENCYCODE'],'exp_date'=>$plan_duration,'plan_duration'=>$planduration,'premium'=>'0');
		
         $dd = $this->dbcon->Insert('itf_payment',$dpayment);
         return "1";
	    }
		
			function PaymentPlanEmployFrontPremium($serLisValue,$ProValue,$userid,$planid,$nojob,$httpParsedResponseAr,$first_name,$last_name,$email,$nojob2)
		 {
			   $nojob3= date('Y-m-d h:i:s', strtotime("+".$nojob2, strtotime(date("Y-m-d h:i:s"))));
			
			$dpayment = array('payer_id'=>$userid,'txn_id'=>$ProValue['TRANSACTIONID'],'payment_amount'=>$ProValue['AMT'],'plan_id'=>$planid,'plan_name'=>$nojob,'all_details_paymeny'=>$serLisValue,'payment_status'=>'SUCCESS','first_name'=>$first_name,'last_name'=>$last_name,'payer_email'=>$email,'mc_currency'=>'$','exp_date'=>$nojob3,'premium'=>'1',);
		//print_r($dpayment); die;
         $dd = $this->dbcon->Insert('itf_payment',$dpayment);
		 if($dd){
			$dqo= "update itf_user_profile set subscription_type='".$nojob."', plan_type='".$nojob."', premium_messaging ='1', amount='".$ProValue['AMT']."', paid='".$ProValue['AMT']."',expiry_date='".$nojob3."' where id='".$userid."'";
			 }
		  $DD1=$this->dbcon->Query($dqo);
         return "1";
	    }
	    
	    
	    	function Userpackagedelete($id){
			
			$sql="delete from itf_user_payment where id in (".$id.")";
			$this->dbcon->Query($sql);
		    return $this->dbcon->querycounter;
			
			
			}
		
           function showAllUserPackage(){
			   
		$sql="select * from itf_user_payment ";
		return $this->dbcon->FetchAllResults($sql);
		
			   }

    function CheckAddUserPackage($UsId)
	{
		$sql="select U.* from itf_user_payment  U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
     function CheckAllUserPackageNew($UsId)
	{
		$sql="select I.*,U.company_name,P.package_name from itf_user_payment I,itf_users U,itf_package P
		 WHERE U.id = I.employ_id AND P.id=I.planid AND I.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
	
	
    function showAllTransactions()
    {
        $sql="select P.*,U.sell_email,U.trans_id from itf_payment P
              LEFT JOIN itf_product U on U.trans_id = P.txn_id
              order by P.id desc";
        return $this->dbcon->FetchAllResults($sql);

    }
	
 function showAllTransactionsByUserid()
    {
       $sql="select P.*,U.email,U.trans_id,U.id as user_id from itf_payment P
              LEFT JOIN itf_users U on U.trans_id = P.txn_id
			  where U.id ='".$_SESSION['FRONTUSER']['id']."'
              order by P.id desc";
        return $this->dbcon->FetchAllResults($sql);

    }


  function CheckTransactions($ids)
    {
     $sql="select U.* from itf_payment U where U.id='".$ids."'";
       return $this->dbcon->Query($sql);

    }



 function showAllTransactionsByPackageUserid()
    {
       $sql="select P.*,U.email,U.trans_id,U.id as user_id from itf_payment P
              LEFT JOIN itf_users U on U.trans_id = P.txn_id
			  where U.id ='".$_SESSION['FRONTUSER']['id']."'
              order by P.id desc";
          return $this->dbcon->Query($sql);

    }
	
	 function showAllTransactionsByEmailid($usid)
    {
       $sql="select P.*,U.email,U.trans_id,U.id as user_id from itf_payment P
              LEFT JOIN itf_users U on U.email = P.payer_email
			  where U.id ='".$_SESSION['FRONTUSER']['id']."'
              order by P.id desc";
        return $this->dbcon->FetchAllResults($sql);

    }

function PaymentBookEvent($serLisValue,$ProValue,$userid,$planid,$planname,$httpParsedResponseAr,$firstname,$last_name,$email,$planduration,$paymentType)
		 {
			   $plan_duration= date('Y-m-d h:i:s', strtotime("+".$planduration, strtotime(date("Y-m-d h:i:s"))));
			
			$dpayment = array('payer_id'=>$userid,'txn_id'=>$ProValue['TRANSACTIONID'],'txn_type'=>$paymentType,'payment_amount'=>$ProValue['AMT'],'event_id'=>$planid,'event_name'=>$planname,'all_details_paymeny'=>$serLisValue,'payment_status'=>'SUCCESS','name'=>$firstname,'last_name'=>$last_name,'user_id'=>$userid,'payer_email'=>$email,'mc_currency'=>$ProValue['CURRENCYCODE'],'exp_date'=>$plan_duration,'plan_duration'=>$planduration);
		
         $dd = $this->dbcon->Insert('itf_eventbook_payment',$dpayment);
         return "1";
	    }
	
	   function showAllEventTransactions()
    {
        $sql="select * from itf_eventbook_payment order by id desc";
        return $this->dbcon->FetchAllResults($sql);

    }
	
		

		 function CheckEventTransactions($ids)
    {
       $sql="select U.* from itf_eventbook_payment U where U.id='".$ids."'";
       return $this->dbcon->Query($sql);

    }
	
	 function showAllProductTransactions()
    {
        $sql="select * from itf_product_payment order by id desc";
        return $this->dbcon->FetchAllResults($sql);

    }
	
	 function CheckProductTransactions($ids)
    {
       
	 $sql="select I.*,U.product_id,U.quantity,U.price,U.txn_id,U.id as tempid from itf_product_temp U,itf_product_payment I
		 WHERE U.txn_id = I.txn_id AND U.user_id=I.user_id AND I.id='".$ids."'";
	  // $sql="select U.* from itf_payment U where U.id='".$ids."'";
       return $this->dbcon->Query($sql);

    }

		
}
?>