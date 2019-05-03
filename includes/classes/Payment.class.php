<?php
class Payment
{
	
	function __construct()
	{
		global $itfmysql;
		$this->dbcon = $itfmysql;
	}

    function addOrder($datas)
    {
        
   
        return $this->dbcon->Insert('itf_order',$datas);
    }

    function addOrderDetails($datas)
    {
      // echo"<pre>";print_r($datas);die;
        return $this->dbcon->Insert('itf_order_detail',$datas);
    }


    public function confirmOrder($order_id)
    {
       // echo "<pre>";print_r($order_id);die;
   
        $datas = array('status'=>1);
        $condition = array('id'=>$order_id);
        $this->dbcon->Modify(' itf_order',$datas,$condition);
  //echo "<pre>";print_r($order_id);die;
        $sql = "Select * from itf_order where id = '".$order_id."' ";
           //echo "<pre>";print_r( $sql);die;
        $order_info = $this->dbcon->Query($sql);
      //   echo "<pre>";print_r($order_info);die;
        $condition2 = array('id'=>$order_info['quote_id']);
        
        $this->dbcon->Modify(' itf_quote',array('payment'=>1),$condition2);
 //echo "<pre>";print_r($order_info);die;
        $sql = "Select * from itf_order_detail where order_id = '".$order_id."' ";
        $bids = $this->dbcon->FetchAllResults($sql);

        foreach($bids as $bid){
            $condition3 = array('id'=>$bid['bid_id']);
            $this->dbcon->Modify(' itf_bid',array('status'=>1),$condition3);
        }

        $sql = "Select * from itf_bid where quote_id = '".$order_info['quote_id']."' and id NOT IN (select bid_id from itf_order_detail where order_id = '".$order_id."') ";
        $nbids = $this->dbcon->FetchAllResults($sql);

        foreach($nbids as $nbid){
            $condition4 = array('id'=>$nbid['id']);
            $this->dbcon->Modify(' itf_bid',array('status'=>2),$condition4);
        }

    }

    public function addPaymentInfo($datas)
    {
        
        
        $datas['order_id'] = $datas['custom'];
        $datas['payment_amount'] = $datas['payment_gross'];
        
       
       // echo"<pre>";print_r($datas);die;
        unset($datas['id']);
        $this->dbcon->Insert('itf_payment',$datas);

    }
     public function updatepaymenttable($datas)
    {
      

     $condition = array('order_id'=>$_SESSION['orderid']);
     $datas['supplierid']=$_SESSION['supplierid'];
     $datas['bidamount']=$_SESSION['bidamount'];
     $datas['quote_id']=$_SESSION['quote_id'];
   
    
            $this->dbcon->Modify('itf_payment',$datas,$condition);
              unset($_SESSION['supplierid']);
     unset($_SESSION['bidamount']);
     unset($_SESSION['quote_id']);
}
}
?>