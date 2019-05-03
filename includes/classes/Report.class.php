<?php

class Report

{

	

	function __construct()

	{

		global $itfmysql;

		$this->dbcon=$itfmysql;

	}

		

		

		

	function admin_addReport($datas)

	{

		

		if(isset($_FILES['upload']['name']) and !empty($_FILES['upload']['name']))

		{

			$fimgname="ITFPDF".time();

			$objimage= new ITFUpload();

			$objimage->load($_FILES['upload']);

			$objimage->save(PUBLICFILE."buying_request_file/".$fimgname);

			$productimagename=$objimage->createnames;

			//echo"<pre>"; print_r($productimagename); die;

			$datas['upload']=$productimagename;

		}



		unset($datas['id']);

		$this->dbcon->Insert('itf_quote',$datas);

	}



	







	function admin_updateReport($datas)

	{

		//print_r($datas);die;

		

		if(isset($_FILES['upload']['name']) and !empty($_FILES['upload']['name']))

		{

			$fimgname="ITFPDF".time();

			$objimage= new ITFUpload();

			$objimage->load($_FILES['upload']);

			$objimage->save(PUBLICFILE."buying_request_file/".$fimgname);

			$productimagename=$objimage->createnames;

			//echo"<pre>"; print_r($productimagename); die;

			$datas['upload']=$productimagename;

		}

		

		$condition = array('id'=>$datas['id']);

		

		unset($datas['id']);

		$this->dbcon->Modify('itf_quote',$datas,$condition);

	}



	

	function CheckReport($UsId)

	{

		$sql="select U.* from itf_quote U where U.id='".$UsId."'";

	 	return $this->dbcon->Query($sql);

	}

	

	

	function showAllOrders()

    {

        $sql="select O.*,D.bid_id,B.bid_desc,U.name as order_user,UD.name as bid_user,Q.quote_name  from itf_order O

              LEFT JOIN itf_order_detail D on D.order_id = O.id

              LEFT JOIN itf_bid B on B.id = D.bid_id

              LEFT JOIN itf_users U on U.id = O.user_id

              LEFT JOIN itf_users UD on UD.id = B.user_id

              LEFT JOIN itf_quote Q on Q.id = O.quote_id

              where O.status='1' order by O.id desc";



        return $this->dbcon->FetchAllResults($sql);

    }

	

	   function CheckState($id)

    {

        $sql="select * from itf_quote where id='".$id."'";

        return $this->dbcon->Query($sql);

    }

	

	

	 function PublishBlock($ids)

    {



        $infos = $this->CheckState($ids);

        if($infos['status']=='1')

            $datas=array('status'=>'0');

        else

            $datas=array('status'=>'1');

        $condition = array('id'=>$ids);

        $this->dbcon->Modify('itf_quote',$datas,$condition);

        return ($infos['status']=='1')?"0":"1";



    }



    function deleteOrder($id)

    {

        $sql="delete from itf_quote where id in(".$id.")";

        $this->dbcon->Query($sql);



        $sql="delete from itf_quote where id in(".$id.")";

        $this->dbcon->Query($sql);



        return $this->dbcon->querycounter;

    }



    function showAllTransactions()

    {

        $sql="select P.*,O.quote_id,O.date_added as order_date,Q.quote_name,U.name as order_user from itf_payment P

              LEFT JOIN itf_order O on O.id = P.order_id

              LEFT JOIN itf_quote Q on Q.id = O.quote_id

              LEFT JOIN itf_users U on U.id = Q.user_id

              order by P.id desc";



        return $this->dbcon->FetchAllResults($sql);

    }



   

 function showAllEnquirySearch($serach_by,$order)

	    {

		

			

        //print_r($order);

		    $where="";

             

                $where= "and catalog_category like ('%".$this->dbcon->EscapeString($serach_by)."%') and location like ('%".$this->dbcon->EscapeString($order)."%')";

                

           $sql="select * from itf_quote where status=1 and approve='0' ".$where." ORDER BY id DESC"; 

			return $this->dbcon->FetchAllResults($sql);

	      }



	 function showAllEnquiryTextSearch($serach_by)
	    {
		    $where="";
                $where= "and catalog_name like ('%".$this->dbcon->EscapeString($serach_by)."%') or description like ('%".$this->dbcon->EscapeString($serach_by)."%') or 
				company_name like ('%".$this->dbcon->EscapeString($serach_by)."%') or catalog_category like ('%".$this->dbcon->EscapeString($serach_by)."%') or location like
				 ('%".$this->dbcon->EscapeString($serach_by)."%')";
          //$sql="select * from itf_quote where status=1 and approve='0' ".$where."  and date_added >= NOW() - INTERVAL 2 MONTH ORDER BY id DESC"; 
             $sql="select * from itf_quote where status=1 ".$where."  ORDER BY id DESC"; 

			return $this->dbcon->FetchAllResults($sql);

	      }





		function showAllEnquiries()

		{

			$sql="select * from  itf_quote order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}

		

		

		function showAllEnquiryFront()

		{  

		  $sql="select * from  itf_quote where status='1' and approve='0' and date_added >= NOW() - INTERVAL 2 MONTH order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}

		

		 function showAllEnquiryFrontbyUser($usid)

		{

			$sql="select * from  itf_quote where user_id='".$usid."' order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}

		

		function showAllEnquiryByid($id)

		{

			$sql="select * from  itf_quote where id='".$id."'";

			   return $this->dbcon->Query($sql);

		}

		







		

		function showBidsByQuote($quote_id)

		{

			$sql = "select B.*,Q.quote_name,Q.quote_desc,U.registration_id as supplier_id,U.name as supplier_name from itf_bid B

					LEFT JOIN itf_quote Q ON Q.id = B.quote_id

					LEFT JOIN itf_users U ON U.id = B.user_id

					where B.quote_id ='".$quote_id."' ";

			$datas = $this->dbcon->FetchAllResults($sql);

			return $datas;

		}

		

		public function showQuoteChat($quote_id)

		{

			$sql = "select Q.chat_text,UNIX_TIMESTAMP(Q.date_added) as added_date,U.name,UP.profile_image,U.registration_id from itf_quote_chat Q

					LEFT JOIN itf_users U ON Q.user_id = U.id

					LEFT JOIN itf_user_profile UP ON U.profile_id = UP.id

					where Q.quote_id ='".$quote_id."' and Q.status = 1 order by Q.id asc";

			$datas = $this->dbcon->FetchAllResults($sql);

		

			return $datas;

		}

		

		function showQuoteByAccount()

		{

		$sql="select O.*,U.name as order_user,D.bid_id,B.bid_desc,Q.id as quote_id,Q.quote_name,Q.quote_status,Q.approve   

					  from itf_order O

					  INNER JOIN itf_users U on U.id = O.user_id

					  LEFT JOIN itf_order_detail D on D.order_id = O.id

					  LEFT JOIN itf_bid B on B.id = D.bid_id

					  LEFT JOIN itf_quote Q on Q.id = O.quote_id

				

				  where O.status='0' and U.payment_type='account' order by O.id desc";

		   

			return $this->dbcon->FetchAllResults($sql);

		

		}

		

		function deleteQuote($id)

		{

			$sql="delete from itf_quote_detail where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

			$sql="delete from itf_bid where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

			$sql="delete from itf_quote where id in(".$id.")";

			$this->dbcon->Query($sql);

		

			$sql="delete from itf_order where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

		

			$sql="delete from itf_quote_chat where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

			$sql="delete from itf_active_quote_chat where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

			$sql="delete from itf_quote_review where quote_id in(".$id.")";

			$this->dbcon->Query($sql);

		

			return $this->dbcon->querycounter;

		}
		
	////////////////////////////////////////////////////////// date - 22-3-206///////////////////////////////	
		
			function CheckRequestByCustomer($UsId)
			{
			
			$sql="select U.* from itf_quote U where U.id='".$UsId."' and user_id='".$_SESSION['FRONTUSER']['id']."' ";
			
			return $this->dbcon->Query($sql);
			
			}
			
		
		

			function RequestDeleteByCustomer($id)
			{
			if(isset($id) and !empty($id))
			{	
			$info = $this->CheckRequestByCustomer($id);
			if(!empty($_FILES['upload']['name'])){
			@unlink(PUBLICFILE."buying_request_file/".$info['upload']);
			}
			}
			$sql="delete from itf_quote where id in(".$id.") and user_id='".$_SESSION['FRONTUSER']['id']."'"; 
			$this->dbcon->Query($sql);
			return $this->dbcon->querycounter;
			
			}

	

}

?>