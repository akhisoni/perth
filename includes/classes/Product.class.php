<?php
class Product
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
		$datas["slug"]= empty($datas["slug"])?Html::seoUrl($datas["pname"]):Html::seoUrl($datas["slug"]);
       //  $datas['category_id'] = implode(",", $datas['category_id']);
     
		if(isset($_FILES['main_image']['name']) and !empty($_FILES['main_image']['name']))
		{
			$fimgname="caproduct_".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['main_image']['tmp_name']);
			$objimage->save(PUBLICFILE."products/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['main_image']= $productimagename;
		}
			unset($datas['id']);
			return $this->dbcon->Insert('itf_product',$datas);
	}
	
  function count_pages($pdfname) {
      $pdftext = file_get_contents($pdfname);
      $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
      return $num;
    }       
	
	//Delete Data
	function admin_delete($id)
	{
        if(isset($id) and !empty($id))
        {
            $info = $this->CheckProduct($id);
            if(isset($info['main_image'])){
                @unlink(PUBLICFILE."products/".$info['main_image']);
            }
            if(isset($info['image'])){
                $images = explode(",",$info['image']);
                foreach ($images as $image){
                    @unlink(PUBLICFILE."products/".$image);
                }
            }
        }
        $sql="delete from itf_product where id in(".$id.")";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}
	
	
		function seller_product_delete($id)
	{
        if(isset($id) and !empty($id))
        {
            $info = $this->CheckProduct($id);
            if(isset($info['main_image'])){
                @unlink(PUBLICFILE."products/".$info['main_image']);
            }
            if(isset($info['image'])){
                $images = explode(",",$info['image']);
                foreach ($images as $image){
                    @unlink(PUBLICFILE."products/".$image);
                }
            }
        }
        $sql="delete from itf_product where id in(".$id.") and seller_id='".$_SESSION['FRONTUSER']['id']."'";
		$this->dbcon->Query($sql);
		return $this->dbcon->querycounter;
	}
	
	//Update Data

	function admin_update($datas)
	{
$datas["slug"]= empty($datas["slug"])?Html::seoUrl($datas["pname"]):Html::seoUrl($datas["slug"]);
        if(isset($_FILES['main_image']['name']) and !empty($_FILES['main_image']['name']))
		{
			$fimgname="caproduct_".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['main_image']['tmp_name']);
			$objimage->save(PUBLICFILE."products/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['main_image']	=	$productimagename;
			$advertiseinfo=$this->CheckProduct($datas['id']);
			@unlink(PUBLICFILE."products/".$advertiseinfo["main_image"]);
		}
		
		$condition = array('id'=>$datas['id']);
		
	
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_product',$datas,$condition);
	}

    function search($search)
    {
       $sql="select P.*, C.catname, PC.catname , MC.catname  from itf_product P
              LEFT JOIN itf_category C ON C.id = P.category_id
              LEFT JOIN itf_category PC ON PC.id = C.parent
              LEFT JOIN itf_category MC ON MC.id = PC.parent
              where P.name like '%".$this->dbcon->EscapeString($search)."%' or P.code like '%".$this->dbcon->EscapeString($search)."%' or P.logn_desc like '%".$this->dbcon->EscapeString($search)."%' or C.catname like '%".$this->dbcon->EscapeString($search)."%' or PC.catname like '%".$this->dbcon->EscapeString($search)."%' or MC.catname like '%".$this->dbcon->EscapeString($search)."%'  ";
        $datas=$this->dbcon->FetchAllResults($sql);
        return $datas;
    }
        
    function upload($id)
    {

        if(isset($id) and !empty($id))
        {
            $info = $this->CheckProduct($id);
            if(!empty($_FILES['main_image']['name'])){
                @unlink(PUBLICFILE."products/".$info['main_image']);
            }
            if(!empty($_FILES['image']['name'][0])){
                $images = explode(",",$info['image']);
                foreach ($images as $image){
                    @unlink(PUBLICFILE."products/".$image);
                }
            }
        }
        if(isset($_FILES['main_image']['name']) and !empty($_FILES['main_image']['name']))
        {
                $fimgname="plucka_".rand();
                $objimage= new ITFImageResize();
                $objimage->load($_FILES['main_image']['tmp_name']);
                $objimage->save(PUBLICFILE."products/".$fimgname);
                $productimagename = $objimage->createnames;

                $datas['main_image'] = $productimagename;
        }
        if(isset($_FILES['image']['name']) and !empty($_FILES['image']['name'][0]))
        {
                $imagename = array();
                foreach($_FILES['image']['name'] as $key=>$files){
                    $fimgname = "plucka_".rand();
                    $objimage = new ITFImageResize();
                    $objimage->load($_FILES['image']['tmp_name'][$key]);
                    $objimage->save(PUBLICFILE."products/".$fimgname);
                    $productimagename = $objimage->createnames;
                    $imagename[] = $productimagename;
                }

                $datas['image'] = implode(",",$imagename);
        }

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


	function ShowAllProduct()
	{
		$sql="select * from itf_product";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
		function ShowAllProductFrontend()
	{
		$sql="select * from itf_product where status=1";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
		function ShowAllProductSeller()
	{
		$sql="select * from itf_product where seller_id='".$_SESSION['FRONTUSER']['id']."'";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	function showAllFeaturedProductsbylocation($id)
	{
		$sql="select * from itf_product where feature=1 and location='".$id."' order by id desc";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	function showAllFeaturedProducts()
	{
		$sql="select * from itf_product where feature=1 order by id desc";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
        
    function getLatestProduct()
	{
		$sql="select * from itf_product where status = 1 order by id desc limit 0,3";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	      
    function getLatestProductbylocation($id)
	{
		$sql="select * from itf_product where status = 1 and location='".$id."' order by id desc limit 0,3";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
	function GetPageData($id)
	{
		$sql="select * from itf_product  where id='".$id."'";
		$datas=$this->dbcon->Query($sql);
	 	return $datas;
	}

	function CheckProduct($UsId)
	{
		$sql="select * from itf_product where id='".$UsId."'";
		return $this->dbcon->Query($sql);
	}
     
	 
	function CheckProductSeller($UsId)
	{
		$sql="select * from itf_product where id='".$UsId."' and seller_id='".$_SESSION['FRONTUSER']['id']."'";
		return $this->dbcon->Query($sql);
	}



    function CheckProductByName($name)
    {
        $sql="select * from itf_product where pname='".$name."'";
        return $this->dbcon->Query($sql);
    }
    
    
    
    function CheckProductByCode($code)
    {
        echo $sql="select * from itf_product where code='".$code."'";
        return $this->dbcon->Query($sql);
    }


    function CheckProductFront($id)
    {
        $sql="select * from itf_product where id='".$id."' and status=1 ";
        return $this->dbcon->Query($sql);
    }

	

	function PublishBlock($ids)
	{	
		$infos=$this->CheckProduct($ids);
		if($infos['status']=='1')
			$datas=array('status'=>'0');
		else
			$datas=array('status'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_product',$datas,$condition);
		return ($infos['status']=='1')?"0":"1";
	}


function PublishFeatureBlock($ids)
	{	
		$infos=$this->CheckProduct($ids);
		if($infos['feature']=='1')
			$datas=array('feature'=>'0');
		else
			$datas=array('feature'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_product',$datas,$condition);
		return ($infos['feature']=='1')?"0":"1";
	}


    function getProductByCategory($catid,$sort = 'id')
    {
        if($sort == 'id'){
            $order_by = 'order by P.'.$sort.' desc';
        }else{
            $order_by = 'order by P.'.$sort.' asc';
        }

        $sql="select P.* from itf_product P where P.category_id = '".$catid."' or P.subcat_id='".$catid."' ".$order_by;

        return  $this->dbcon->FetchAllResults($sql);;
    }
	
	   function getProductByAlphabet($catid,$sort = '0-9')
    {
        if($sort == '0-9'){
            $order_by = 'order by P.name desc';
		 $sql="select P.* from itf_product P where P.category_id = '".$catid."' order by id DESC";
        }else{
            $order_by = 'order by P.id asc';
			$sql="select P.* from itf_product P where P.category_id = '".$catid."' AND P.name like '".$this->dbcon->EscapeString($sort)."%'";
        }
        return  $this->dbcon->FetchAllResults($sql);;
    }
    
      function getProductByAlphabetSearch($sort = '0-9')
    {
        if($sort == '0-9'){
            $order_by = 'order by P.name desc';
		  $sql="select P.* from itf_product P  order by id DESC";
        }else{
            $order_by = 'order by P.id asc';
		 $sql="select P.* from itf_product P where P.name like '".$this->dbcon->EscapeString($sort)."%'";
        }

         

        return  $this->dbcon->FetchAllResults($sql);;
    }
    
     function ShowAllProductsSearch($txtsearch)

	{

		$sql="select * from itf_product where pname like '%".$this->dbcon->EscapeString($txtsearch)."%' or  code like '%".$this->dbcon->EscapeString($txtsearch)."%'";            
		return $this->dbcon->FetchAllResults($sql);

	}


    function AllRelatedProduct($catid)
	{
		$sql="select * from itf_product where category_id ='".$catid."' and status=1 order by id desc";            
		return $this->dbcon->FetchAllResults($sql);
	}
	
	function GetEmail($id)
	{
		$sql="select * from itf_mails where id='".$id."'";
		return $this->dbcon->Query($sql);
	}
	


			function GetAdminEmail1(){
			
			$sql="select * from itf_users where id=1";
			$datas=$this->dbcon->Query($sql);
			return $datas;
			}
		
		function GetSellerEmail($id){
	
			$sql="select * from itf_users where id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
		
				function GetUserEmail($id){
	
			$sql="select * from itf_users where profile_id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
		
		function GetVendorEmail($id){
	
			$sql="select * from itf_users where profile_id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
		
		
			function GetLocationName($id)
	{
		$sql="select * from itf_state where id='".$id."'";
		return $this->dbcon->Query($sql);
	}
	
		
		
     function Add_Buying_Request($datas)
	 {
			$email = $datas['email'];
			$name = $datas['name'];
			//print_r($datas); die;
			$datas['catalog_category'] = implode(',',$datas['catalog_category']);
			if(isset($_FILES)) {
			$tot = count($_FILES["upload"]["name"]); //To get total count of selected files.
			for($i=0; $i<$tot; $i++) {
			$file_name = $_FILES["upload"]["name"][$i];
			if($file_name!='') {
			$target_dir = PUBLICFILE."buying_request_file/";
			$target_file = $target_dir.$file_name;
			if(move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $target_file)){
			} else{
			echo $res = 'Files Successfully Not Uploaded'; }
			}
			$productimagename[]=$_FILES["upload"]["name"][$i];
			$datas['upload']= implode(',',$productimagename);		
			}}
			unset($datas['id']);
			$this->dbcon->Insert('itf_quote',$datas);
			$emailadmin =$this->GetAdminEmail1();
			$emailadmin1 = $emailadmin['email'];
			$to = $emailadmin['email'];
			$from = $datas['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Buying Request On Plucka.com';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="0" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hi Plucka Member,</p>
						<p>'.$name .', Place a Buying Request on Plucka Site</p><br>
						<p>These are following detail of User</p>
						<p>Name : '.$name .' </p>
						<p>Email Id : '.$email.' </p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<br />
						<br />
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Plucka Team</strong></p></td>
						</tr>
						 <tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://plucka.co/" style="color:#fff;">Plucka</a></td>
						</tr>
						</table>';
						//$ok = @mail($to , $subject, $message, $headers); 
						return $datas;

	}
	
		
		  function GetByuerEmail($id){
			$sql="select * from itf_users where id='".$id."'";
			$datas=$this->dbcon->Query($sql);
			return $datas;
        }
	
		
     function Update_Buying_Request_for_offer($datas)
	 {
		   // print_r($datas); die;
			$sellerid = $datas['seller_id'];
			$condition = array('id'=>$datas['id']);
			unset($datas['id']);
			$datas['user_id'] = $_SESSION['FRONTUSER']['id'];
			$this->dbcon->Modify('itf_quote',$datas,$condition);
			$buyer =$this->GetByuerEmail($datas['user_id']);
			$emailadmin =$this->GetAdminEmail1();
			$selleremail =$this->GetSellerEmail($sellerid);
			$selleremailid = $selleremail['email'];
			$emailadmin1 = $emailadmin['email'];
			$to = $selleremail['email'];
			$from = $buyer['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Offer Accepted By Buyer';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="0" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Plucka Member,</p>
						<p>Your offer accpted by the buyer</p>
						<p>Please visit your Dashboard to view the acceptance</p>
						<p>Buying Request URL : http://plucka.co/index.php?itfpage=view_request&itemid=view_detail&id='.$datas['id'].'</p>
						<br /><br />
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
	
	 function Add_Buying_Request_Details($datas)
	 {
		//print_r($datas);
			$product = $datas['product_url'];
			$email = $datas['email'];
			$name = $datas['name'];	
			$sellerid = $datas['seller_id'];
			unset($datas['id']);
			$this->dbcon->Insert('itf_product_enquiry',$datas);
			$emailadmin =$this->GetAdminEmail1();
			$selleremail =$this->GetSellerEmail($sellerid);
			$selleremailid = $selleremail['email'];
			$emailadmin1 = $emailadmin['email'];
			$maildatavalue = $this->GetEmail(11);
			$to = $selleremail['email'];
			$from = $datas['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Catalogue Enquiry On Plucka.com';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://plucka.co/" style="color:#FFFFFF;"><img border="0" src="http://plucka.co/template/default/image/logo.png" title="Plucka"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Plucka Member,</p>
						<p>There has been an enquiry placed about your Catalogue on the Plucka site</p>
						<p>Following are the details of the enquirer</p>
						<p>Name : '.$name .' </p>
						<p>Email Id : '.$email.' </p>
						<p>Company name : '.$datas['company_name'].' </p>
						<p>Message : '.$datas['description'].' </p>
						<p>Catalogue URL : '.$product.' </p>
						<p>Catalogue Name : '.$datas['catalog_name'].' </p>
						<br /><br />
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
	
	
	    function getAllRecordMainsearch($data)
	    {
		$data['name'];
		
		  if(isset($data['cat_id']) and $data['cat_id']!=null)
			{
				$wherecondition=" and category_id='".$data['cat_id']."'";
				
			}
		
			if(isset($data['name_check']) and $data['name_check']=='1')
             {
				$wherecondition.=" and name='".$data['name']."'";
			}
			if(isset($data['name']) and $data['name']!=null)
			 {
				
				 $wherecondition.=" and name like '".$data['name']."'";
				}
			
			
			if(isset($data['id']) and $data['id']!=null)
             {
				$wherecondition.=" and id='".$data['id']."'";
			}
			
			
			
		  
			
			if(isset($data['location']) and $data['location']!=null)
             {
				$wherecondition.=" and location='".$data['location']."'";
			}
			
			if(isset($data['zip']) and $data['zip']!=null)
             {
				$wherecondition.=" and zip='".$data['zip']."'";
			}
			
		
			
			if(isset($data['minprice'])!='' and  $data['maxprice']!='')
           {
				  $wherecondition.= " and price <=".$data['maxprice']." and price >".$data['minprice'] ;   
			}
			
	    $sql="select * from itf_product where status=1" .$wherecondition." order by id"; 
				 
			return $this->dbcon->FetchAllResults($sql); 
	      }	 
		  
		  
		  
		  	function AddFrontEndAds($datas)
		{	
		$userid=$_SESSION['FRONTUSER']['id'];

		if($userid!=''){
		$datas['seller_id']=$userid;
		}
		
		if(isset($_FILES['image']) and !empty($_FILES['image']))
			{
			for($i=0; $i<count($_FILES['image']['name']); $i++)
			{
				if(!empty($_FILES['image']['name'][$i])):
					$fimgname='product_'.rand(6, 5000000);
					$objimage= new ITFImageResize();
					$objimage->load($_FILES['image']['tmp_name'][$i]);
					$objimage->save(PUBLICFILE."products/".$fimgname);
					$productimagename[]=$objimage->createnames;
				endif;
			}
	                $datas['image']	= serialize($productimagename);
					
		}

		
		unset($datas['id']);
		$this->dbcon->Insert('itf_product',$datas);
			}
	 
		  
	 function showAllProductFrontbyUser($usid)

		{

			$sql="select * from  itf_product where seller_id='".$usid."' order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}
		
		function CheckRequestByCustomer($UsId)
			{
			
			$sql="select U.* from itf_product U where U.id='".$UsId."' and seller_id='".$_SESSION['FRONTUSER']['id']."' ";
			
			return $this->dbcon->Query($sql);
			
			}
		
		function RequestDeleteByCustomer($id)
			{
			if(isset($id) and !empty($id))
			{	
			$info = $this->CheckRequestByCustomer($id);
			if(!empty($_FILES['upload']['name'])){
			@unlink(PUBLICFILE."products/".$info['upload']);
			}
			}
			$sql="delete from itf_product where id in(".$id.") and seller_id='".$_SESSION['FRONTUSER']['id']."'"; 
			$this->dbcon->Query($sql);
			return $this->dbcon->querycounter;
			
			}
	  
		  
		function showAllProductbyid($id)

		{

			$sql="select * from  itf_product where id='".$id."'";

			   return $this->dbcon->Query($sql);

		}
		function showAllNewProductFront()

		{

			$sql="select * from  itf_product where status=1 order by id DESC";

			   return  $this->dbcon->FetchAllResults($sql);;

		}
	  
	  
	  
	   function Ad_Enquiry_Request($datas)
	 {
		//print_r($datas);
			
			unset($datas['id']);
			$this->dbcon->Insert('itf_product_enquiry',$datas);
			$emailadmin =$this->GetAdminEmail1();
			$selleremail =$this->GetSellerEmail($sellerid);
			$selleremailid = $selleremail['email'];
			$emailadmin1 = $emailadmin['email'];
			$maildatavalue = $this->GetEmail(11);
			$to = $selleremail['email'];
			$from = $datas['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			$headers .= "Cc: ".$emailadmin['email']. "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Ad Enquiry On Australiads';
			$message = '<table width="642" border="1" align="center" cellpadding="5" cellspacing="0">
						<tr>
						<td height="83" style="font-size:25px; background:#143e7e;">
						<a href="http://australiads.com" style="color:#FFFFFF;"><img border="0" src="http://australiads.com/template/default/image/logo.png" title="Australiads"></a></td>
						</tr>
						<tr>
						<td style=" background:#f0f0f0;"><br>
						<p>Hello Australiads Member,</p>
						<p>There has been an enquiry placed on your ad</p>
						<p>Following are the details of the enquirer</p>
						<p>Name : '.$name .' </p>
						<p>Email Id : '.$email.' </p>
						<p>Message : '.$datas['description'].' </p>
						<p>Ad URL : '.$datas['producturl'].' </p>
						<br /><br />
						<p> <strong>Thanks and Regards<br />
						&nbsp;&nbsp;The Australiads Team </strong></p></td>
						</tr>
						<tr style="background:#000;">
						<td height="52" align="center" style="font-size:22px;"><a href="http://australiads.com" style="color:#fff;">Australiads</a></td>
						</tr>
						</table>';
						$ok = @mail($to , $subject, $message, $headers); 
         	 	return $datas;
		
		
	}
	
	function showAllEnquiries()
		{
			$sql="select * from  itf_product_enquiry order by id DESC";
			return $this->dbcon->FetchAllResults($sql);
		}
		
		
	function CheckEnquiries($UsId)
	{
		$sql="select U.* from itf_product_enquiry U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
	}
	
		function Addfav($id){
	    $userid=$_SESSION['FRONTUSER']['id'];
		 $condition = array('id'=>$ids);
		$datas['userid']= $userid;	
		$datas['product_id']= $id;	
	$this->dbcon->Insert('itf_favorites',$datas);
	}
    
	
	
	 function showAllFavbyUser($usid)

		{

			$sql="select * from  itf_favorites where userid ='".$usid."' order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}
		
		
		function CheckFavByCustomer($UsId)
			{
			
			$sql="select U.* from itf_favorites U where U.id='".$UsId."' and userid='".$_SESSION['FRONTUSER']['id']."' ";
			
			return $this->dbcon->Query($sql);
			
			}
		
		function FavDeleteByCustomer($id)
			{
			if(isset($id) and !empty($id))
			{	
			$info = $this->CheckFavByCustomer($id);
			if(!empty($_FILES['upload']['name'])){
			@unlink(PUBLICFILE."products/".$info['upload']);
			}
			}
			$sql="delete from itf_favorites where id in(".$id.") and userid='".$_SESSION['FRONTUSER']['id']."'"; 
			$this->dbcon->Query($sql);
			return $this->dbcon->querycounter;
			
			}
            
			
			 function showAllNewProductPriceLowtoHigh()

		{

		$sql="select * from  itf_product where status=1 order by price ASC";

			   return  $this->dbcon->FetchAllResults($sql);;

		}
		
		 function showAllNewProductPriceHightoLow()

		{

		$sql="select * from  itf_product where status=1 order by price DESC";

			   return  $this->dbcon->FetchAllResults($sql);;

		}
	  
		function getProductByCategoryBySort($catid,$sortby)
    {
		
        if($sortby == 'newest'){
            $order_by = 'order by P.id desc';}
			
        if($sortby == 'pricelow'){
            $order_by = 'order by P.price ASC';
        }
		 if($sortby == 'pricehigh'){
            $order_by = 'order by P.price DESC';
        }


       $sql="select P.* from itf_product P where P.category_id = '".$catid."' or P.subcat_id='".$catid."' ".$order_by;

        return  $this->dbcon->FetchAllResults($sql);;
    }
		
		
		function getProductBySearchBySort($sortby)
    {
		
        if($sortby == 'newest'){
            $order_by = 'order by P.id desc';}
			
        if($sortby == 'pricelow'){
            $order_by = 'order by P.price ASC';
        }
		 if($sortby == 'pricehigh'){
            $order_by = 'order by P.price DESC';
        }


      $sql="select P.* from itf_product P where P.status=1 ".$order_by;

        return  $this->dbcon->FetchAllResults($sql);;
    }
		

	function ShowAllProductFree()
	{
		$sql="select * from itf_product where ad_type='0' order by id desc";
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	
	function ShowAllProductPaid()
	{
		
		$sql="select P.*,U.txn_id,U.payment_amount,U.payment_status,U.payer_email from itf_product P
              LEFT JOIN itf_payment U on P.trans_id = U.txn_id
			  where P.ad_type ='1' order by P.id desc";
      
		$datas=$this->dbcon->FetchAllResults($sql);
	 	return $datas;
	}
	
	  
	  function CheckProductAd($session_id)
	{
		$sql="select * from itf_product where session_id='".$session_id."'"; 
		return $this->dbcon->Query($sql);
	}
	  
		   function AdUpdateFront($datas)
    {
       $userinfo = $this->CheckProductAd($datas['session_id']);
        $condition = array('session_id'=>$datas['session_id']);
        $this->dbcon->Modify('itf_product',$datas,$condition);
          }
		  
       function CheckProductPaid($UsId)
	{
		$sql="select P.*,U.txn_id,U.payment_amount,U.payment_status,U.payer_email from itf_product P
              LEFT JOIN itf_payment U on P.trans_id = U.txn_id
			  where P.id='".$UsId."'";
			  
		return $this->dbcon->Query($sql);
		
	}
	
	function showAllProductFrontbyUserIdOrEmailFree($usid,$email)

		{

			$sql="select * from  itf_product where seller_id='".$usid."' or sell_email='".$email."' and ad_type='0' order by id DESC";

			return $this->dbcon->FetchAllResults($sql);

		}
		
		function showAllProductFrontbyUserIdOrEmailPaid($usid,$email)

		{

			$sql="select P.*,U.txn_id,U.payment_amount,U.payment_status,U.payer_email from itf_product P
              LEFT JOIN itf_payment U on P.trans_id = U.txn_id
			  where P.seller_id='".$usid."' or P.sell_email='".$email."' and P.ad_type='1'";

			return $this->dbcon->FetchAllResults($sql);

		}
		
		
			function showAllHomeGalleryPaidProducts()
	{
		$sql="select * from itf_product where feature='1' and ad_type='1' and package_id='1' order by id desc";
		return $this->dbcon->FetchAllResults($sql);
	 	 
	}
	
		function showAllTopPaidProducts()
	{
		 $sql="select * from itf_product where ad_type='1' and package_id='2' order by id desc limit 0,3";
		return $this->dbcon->FetchAllResults($sql);
	 	 
	}
	
	function showAllPaidNewProductFront()
		{
			$sql="select * from itf_product where feature='1' and ad_type='1' order by id DESC";
			   return  $this->dbcon->FetchAllResults($sql);;

		}
	    
		
			
	 function getOrderlistByUser($user_id)
	{
/*$sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id AND U.email=P.email
		  LEFT JOIN itf_order O on U.profile_id = O.usid
          where U.profile_id='".$user_id."'";*/	  
		  
     $sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id, A.order_ids, MAX(A.status_id), A.id as aid from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id
		  LEFT JOIN itf_order O on U.profile_id = O.usid
        LEFT JOIN itf_app_order_status A on O.id = A.order_ids
          where U.profile_id='".$user_id."' group by O.id order by A.id DESC ";	  
	
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
	 function getOrderlistByRiderId($rider_id)
	{
$sql="select O.*,O.id as order_id, R.orderid, R.rider_id, A.order_ids, MAX(A.status_id), A.id as aid from itf_order O
		  LEFT JOIN itf_assign_rider R on O.id = R.orderid
		  LEFT JOIN itf_app_order_status A on O.id = A.order_ids
          where R.rider_id='".$rider_id."'  group by O.id order by A.id DESC ";	  
	
	
		  		  
     /*$sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id, A.order_ids, MAX(A.status_id), A.id as aid from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id 
		  LEFT JOIN itf_order O on U.profile_id = O.vendor_id
        LEFT JOIN itf_app_order_status A on O.id = A.order_ids
          where U.profile_id='".$vendor_id."' group by O.id order by A.id DESC ";	  */
		  
	
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
		 function getOrderDetailByUser($user_id, $order_id)
	{
   $sql="select * from itf_order where usid='".$user_id."' and id='".$order_id."'";	  
		return $this->dbcon->Query($sql);	
	}
	
	
		 function getOrderDetailByUserLatest($user_id, $order_id)
	{
 
		$sql="select O.*,O.id as order_id,  A.order_ids, A.status_id from itf_order O
     LEFT JOIN itf_app_order_status A on O.id = A.order_ids
     where O.usid='".$user_id."' and O.id='".$order_id."' order by A.status_id DESC";	  
		return $this->dbcon->Query($sql);	
	}
	
	
		 function getOrderDetailByVendorId($vendor_id, $order_id)
	{
   $sql="select * from itf_order where vendor_id='".$vendor_id."' and id='".$order_id."'";	  
		return $this->dbcon->Query($sql);	
	}
	
	
	
		 function getOrderDetailByVendorIdLatest($vendor_id, $order_id)
	{
    $sql="select O.*,O.id as order_id,  A.order_ids, A.status_id from itf_order O
     LEFT JOIN itf_app_order_status A on O.id = A.order_ids
     where O.vendor_id='".$vendor_id."' and O.id='".$order_id."' order by A.status_id DESC";	  
		return $this->dbcon->Query($sql);	
	}
	
	
	 function getOrderDetailByRiderId($rider_id, $order_id)
	{
		 $sql="select O.*,O.id as order_id, R.orderid, R.rider_id from itf_order O
		  LEFT JOIN itf_assign_rider R on O.id = R.orderid
          where R.rider_id='".$rider_id."' and O.id= '".$order_id."' ";	  

		return $this->dbcon->Query($sql);	
	}
	
	
	 function getOrderDetailByRiderIdLatest($rider_id, $order_id)
	{
		$sql="select O.*,O.id as order_id, R.orderid, R.rider_id, A.order_ids, A.status_id from itf_order O
		  LEFT JOIN itf_assign_rider R on O.id = R.orderid
		  LEFT JOIN itf_app_order_status A on O.id = A.order_ids
          where R.rider_id='".$rider_id."' and O.id= '".$order_id."' order by A.status_id DESC";	  

		return $this->dbcon->Query($sql);	
	}
	
	
	
		 function getOrderItemByOrderId($order_id)
	{
   $sql="select * from itf_order_items where order_id='".$order_id."'";	  
		$datas = $this->dbcon->FetchAllResults($sql);
	return $datas;
	
	
	}
	
	function PublishBlockOrderStatus($ids)
	{	
		$infos=$this->CheckOrderStatusByid($ids);
		if($infos['active_status']=='1')
			$datas=array('active_status'=>'11');
		else
			$datas=array('active_status'=>'1');
		$condition = array('id'=>$ids);
		$this->dbcon->Modify('itf_order',$datas,$condition);
		return ($infos['active_status']=='1')?"11":"1";
	}
	
	
			 function CheckOrderStatusByid($order_id)
	{
 $sql="select * from itf_order where id='".$order_id."'";	  
		return $this->dbcon->Query($sql);	
	
	}
	
		
		 function getProductsByOrderId($order_id)
	{
 $sql="select * from itf_order where id='".$order_id."'";	  
		$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	
	}
	
		function showAllProductbyidByUserOrder($id)
		{
			 $sql="select * from  itf_product where id='".$id."'";
			 $datas = $this->dbcon->FetchAllResults($sql);
	return $datas;
		}
	
	 function getOrderlistByVendor($vendor_id)
	{
/*$sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id AND U.email=P.email
		  LEFT JOIN itf_order O on U.profile_id = O.vendor_id
          where U.profile_id='".$vendor_id."' order by O.id DESC";	
		  */
		  
		  		  
     $sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id, A.order_ids, MAX(A.status_id), A.id as aid from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id 
		  LEFT JOIN itf_order O on U.profile_id = O.vendor_id
        LEFT JOIN itf_app_order_status A on O.id = A.order_ids
          where U.profile_id='".$vendor_id."' group by O.id order by A.id DESC ";	  
		  
		    
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
	 function getOrderlistByVendorDateSorting($vendor_id,$startdate,$enddate)
	{
$sql="select U.*,U.id as user_id,P.*,O.*,O.id as order_id from itf_users U
          LEFT JOIN itf_user_profile P on U.profile_id = P.id AND U.email=P.email
		  LEFT JOIN itf_order O on U.profile_id = O.vendor_id
          where U.profile_id='".$vendor_id."' and (O.date_added BETWEEN '".$startdate."' AND '".$enddate."') order by O.id DESC";	  
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	function CheckVendorProfile($id)
    {
        $sql="select * from itf_user_profile where id='".$id."'";
        return $this->dbcon->Query($sql);
    }
	function GetCategoryName($id)
	{
		$sql="select * from itf_category where id='".$id."'";
		return $this->dbcon->Query($sql);

	}

	
	function ShowPaymentmodebyid($UsId)
	{
		 $sql="select U.* from itf_payment_mode_status U where U.id='".$UsId."'";
	 	return $this->dbcon->Query($sql);
		
	}
	
	
	 function Add_Users_Order($datas)
	 { 
	 
	 $datas['date_added'] = date('Y-m-d H:i:s');
	 
		$params = (array) json_decode(file_get_contents('php://input'), TRUE);
		
	$productid = $params['product_detail'][0]['product_id'];
	if($productid){
		    $datas['usid'] = $datas['user_id'];
		     $datas['users_id'] = $datas['user_id'];
		   $datas['vendors_id'] = $datas['vendor_id'];
		   $datas['status_id'] = 1;
		   $datas['order_status'] = 1;
			unset($datas['id']);
			$orderid = $this->dbcon->Insert('itf_order',$datas);
			$datas['order_ids'] = $orderid;
			$statusid = $this->dbcon->Insert('itf_app_order_status',$datas);
	    foreach($params['product_detail'] as $key=>$pro){
		
	       $info = array(
		         "order_id"=>mysql_real_escape_string($orderid),
				'product_id'=>mysql_real_escape_string($pro['product_id']),
				'quantity'=>mysql_real_escape_string($pro['quantity']),
				'product_price' =>mysql_real_escape_string($pro['product_price']),
				);
				$data = $this->dbcon->Insert('itf_order_items',$info);
				
	} 
	       $vendorname = $this->CheckVendorProfile($datas['vendor_id']);
		  $paymode = $this->ShowPaymentmodebyid($datas['payment_mode']);
             $useremail = $this->GetUserEmail($datas['user_id']);
			  $vendoremail = $this->GetVendorEmail($datas['vendor_id']);
		
			$emailadmin =$this->GetAdminEmail1();
			$to1 = $useremail['email'];
			$to2 = $vendoremail['email'];
			$to3 = $emailadmin['email'];
			$from = $emailadmin['email'];
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Reply-To: ". strip_tags($_POST[$emailadmin['email']]) . "\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subjectvendor = 'Order Placed On Creaseart APP';
			$subjectadmin = 'Order Placed On Creaseart APP';
			$subjectuser = 'Order Placed On Creaseart APP';
			$messageuser.= '<table align="center" cellpadding="0" cellspacing="0" width="95%%">
  <tr>
     <table align="center"  cellpadding="0" cellspacing="0" width="600" style="border-collapse: separate; border-spacing: 2px 5px; box-shadow: 1px 0 1px 1px #B8B8B8;" bgcolor="#F6EFE6">
        <tr>
          <td align="center" style="padding: 5px 5px 5px 5px;"><a href="#" target="_blank">
         <a href="https://www.creaseart.com/" target="_blank">  <img src="https://www.creaseart.com//template/default/images/logo.png" alt="Creaseart" style="width:80px;border:0;"/> </a></td>
        </tr>
        <tr>
          <td align="center"><!-- Initial relevant banner image goes here under src--> 
            <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%; border-radius: 6px; background:#fcfcfc"">
<tbody>
<tr style="padding:0;text-align:left;vertical-align:top">
<th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:10px;text-align:left;width:564px">
<table style="border-collapse:collapse;;padding:0;text-align:left;vertical-align:top;width:100%;">
<tbody><tr style="padding:0;text-align:left;vertical-align:top">
<th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left">
<h6  style="margin:0;;color:inherit;font-family:sans-serif;font-size:18px;font-weight:400;line-height:1.3;padding:0;text-align:left;word-wrap:normal">Hi '.$useremail['name'].',
</h6>
<p style="margin:0;;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:normal;margin-top:12px;padding:0;text-align:left">Thank you for placing an order with Creaseart. Your order details are given below.</p>
</th>
<th  style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0">
</th>
</tr>
</tbody></table>
</th>
</tr>
</tbody>
</table></td>
        </tr>
       <tr style="padding:0;text-align:left;vertical-align:top">
      <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> 
      <p style="margin:0;color:#333;font-family:sans-serif;font-size:17px;font-weight:600;line-height:1.4;margin-top:5px;padding:0;text-align:left; margin-left:20px;">'.$vendorname['company_name'].'</p>
        <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;line-height:1.4;margin-top:8px;padding:0;text-align:left; margin-left:20px;">Order Id: '.$orderid.'</p>
          <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;margin-top:1px;padding:0;text-align:left; margin-left:20px;">Order Date: '.$datas['date_added'].'</p>
 <div style="border-top:1px solid #FCFCFC;margin-bottom:5px;margin-top:16px"></div>
<p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;">
 <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png">
 <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Pickup Time - </span>
 
  <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['pickup_date'].' | '.$datas['pickup_time'].'</span>  </p>
 <p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;">
 <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png">
 <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Delivery Time - </span>
 
  <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['deliver_date'].' | '.$datas['deliver_time'].'</span>  </p>        
                 
   
        <div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>
        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:15px;">
          <tbody>
            <tr style="padding:0;text-align:left;vertical-align:top">
              <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:left;width:50%">ITEMS</th>
              <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">PRICE</th>
              <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:14%">QTY</th>
              <th  style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">TOTAL</th>
            </tr>';
           
           
          foreach($params['product_detail'] as $key=>$pro){
			 $product = $this->showAllProductbyid($pro['product_id']);
			 $catname1 = $this->GetCategoryName($product['category_id']);
			  $catname2 = $this->GetCategoryName($product['subcat_id']);
          $messageuser.= '<tr style="padding:0;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:13px;text-align:left;vertical-align:top;word-wrap:break-word">'.$catname1['catname'].' | '. $product['pname'].' ('.$catname2['catname'].')</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">₹ '.$pro['product_price'].'</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">'.$pro['quantity'].'</td>
              <td style="font-family:sans-serif;font-size:13px;padding:0;padding-bottom:16px;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$pro['quantity'] * $pro['product_price'].'</td>';
           $messageuser.= '</tr>';
		   }
        $messageuser.= '</tbody>';
        $messageuser.='</table>';
        $messageuser.='<div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>';
        
       $messageuser.='<table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:70px;">
          <tbody>
          
        
      
            <tr style="padding:10px;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Sub Total</td>
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['amount'].'</td>
            </tr> 
             <tr style="padding:10px;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Discount</td>
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['discount'].'</td>
            </tr> 
               <tr style="padding:10px;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Tax</td>
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['gst_amount'].'</td>
            </tr> 
               <tr style="padding:10px;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Total</td>
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['total_amount'].'</td>
            </tr> 
       
             <tr style="padding:10px;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Payment Mode</td>
              <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">'.$paymode['payment_name'].'</td>
            </tr> 
          </tbody>
        </table>
      </th>
    </tr>
    
       <tr>
          <td bgcolor="#F8F7F0" style="padding:5px;">
              
                 <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
<tbody>
<tr style="padding:0;text-align:left;vertical-align:top">
<th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;padding-bottom:24px;padding-left:32px;padding-right:32px;padding-top:24px;text-align:left;width:564px">
<table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
<tbody><tr style="padding:0;text-align:left;vertical-align:top">
<th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left">
<p style="font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left">
<img src="https://www.creaseart.com/images/location.png" style="clear:both;display:inline-block;height:13px;margin-right:0px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="location.png">
<span style="display:inline-block;font-size:14px;font-weight:600;vertical-align:middle;width:144px">Delivery Address:</span>
  <span style="display:inline-block;font-size:13px;font-weight:500;vertical-align:top">'.$datas['user_address'].'</span>
</p>
</th>
<th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0"></th>
</tr>
</tbody></table>
</th>
</tr>
</tbody>
</table>   
   
          </td>
        </tr>
        <tr>
          <td bgcolor="#F8F7F0" style="padding:5px;"><table cellpadding="0" cellspacing="0" width="100%%">
              <tr>
                <td align="center"><table cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="padding:5px;"><a href="https://www.facebook.com/creaseartapp" target="_blank"> <img src="https://www.creaseart.com/images/facebook.png" alt="Facebook" style="display: block;"/> </a></td>
                      <td style="padding:5px;"><a href="https://twitter.com/ArtCrease" target="_blank"> <img src="https://www.creaseart.com/images/twitter.png" alt="twitter" style="display: block;"/> </a></td>
                      <td style="padding:5px;"><a href="https://www.instagram.com/creaseartapp/" target="_blank"> <img src="https://www.creaseart.com/images/instagram.png" alt="instagram" style="display: block;"/> </a></td>
                      <td style="padding:5px;"><a href="https://www.youtube.com/channel/UCTwVa9gPwKbpKfG0gHTAkJA" target="_blank"> <img src="https://www.creaseart.com/images/youtube.png" alt="youtube" style="display: block;"/> </a></td>
                      <td style="padding:5px;"><a href="https://www.linkedin.com/in/crease-art-97a2a7174/" target="_blank"> <img src="https://www.creaseart.com/images/linkedin.png" alt="linkedin" style="display: block;"/> </a></td>
                       <td style="padding:5px;"><a href="tel:+91 810 202 0271" target="_blank"> <img src="https://www.creaseart.com/images/call.png" alt="linkedin" style="display: block;"/> </a></td>
                        <td style="padding:5px;"><a href="mailto:info@creaseart.com" target="_blank"> <img src="https://www.creaseart.com/images/email.png" alt="linkedin" style="display: block;"/> </a></td>
                    </tr>
                  </table></td>
              </tr>
              </table>
           </td>
        </tr>
      </table>
      </td>
  </tr>
</table>';
$messagevendor.= '
<table align="center" cellpadding="0" cellspacing="0" width="95%%">
  <tr>
    <table align="center"  cellpadding="0" cellspacing="0" width="600" style="border-collapse: separate; border-spacing: 2px 5px; box-shadow: 1px 0 1px 1px #B8B8B8;" bgcolor="#F6EFE6">
      <tr>
        <td align="center" style="padding: 5px 5px 5px 5px;"><a href="#" target="_blank"> <a href="https://www.creaseart.com/" target="_blank"> <img src="https://www.creaseart.com//template/default/images/logo.png" alt="Creaseart" style="width:80px;border:0;"/> </a></td>
      </tr>
      <tr>
        <td align="center"><!-- Initial relevant banner image goes here under src-->
          
          <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%; border-radius: 6px; background:#fcfcfc"">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:10px;text-align:left;width:564px"> <table style="border-collapse:collapse;;padding:0;text-align:left;vertical-align:top;width:100%;">
                    <tbody>
                      <tr style="padding:0;text-align:left;vertical-align:top">
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <h6  style="margin:0;;color:inherit;font-family:sans-serif;font-size:18px;font-weight:400;line-height:1.3;padding:0;text-align:left;word-wrap:normal">Hi '.$vendorname['company_name'].', </h6>
                          <p style="margin:0;;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:normal;margin-top:12px;padding:0;text-align:left">A New Order Placed On Creaseart APP. Order details are given below.</p>
                        </th>
                        <th  style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0"> </th>
                      </tr>
                    </tbody>
                  </table>
                </th>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr style="padding:0;text-align:left;vertical-align:top">
        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <p style="margin:0;color:#333;font-family:sans-serif;font-size:17px;font-weight:600;line-height:1.4;margin-top:5px;padding:0;text-align:left; margin-left:20px;">'.$useremail['name'].'</p>
          <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;line-height:1.4;margin-top:8px;padding:0;text-align:left; margin-left:20px;">Order Id: '.$orderid.'</p>
          <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;margin-top:1px;padding:0;text-align:left; margin-left:20px;">Order Date: '.$datas['date_added'].'</p>
          <div style="border-top:1px solid #FCFCFC;margin-bottom:5px;margin-top:16px"></div>
          <p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;"> <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png"> <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Pickup Time - </span> <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['pickup_date'].' | '.$datas['pickup_time'].'</span> </p>
          <p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;"> <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png"> <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Delivery Time - </span> <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['deliver_date'].' | '.$datas['deliver_time'].'</span> </p>
          <div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>
          <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:15px;">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:left;width:50%">ITEMS</th>
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">PRICE</th>
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:14%">QTY</th>
                <th  style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">TOTAL</th>
              </tr>
            ';
            
            
            foreach($params['product_detail'] as $key=>$pro){
            $product = $this->showAllProductbyid($pro['product_id']);
            $catname1 = $this->GetCategoryName($product['category_id']);
            $catname2 = $this->GetCategoryName($product['subcat_id']);
            $messagevendor.= '
            <tr style="padding:0;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:13px;text-align:left;vertical-align:top;word-wrap:break-word">'.$catname1['catname'].' | '. $product['pname'].' ('.$catname2['catname'].')</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">₹ '.$pro['product_price'].'</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">'.$pro['quantity'].'</td>
              <td style="font-family:sans-serif;font-size:13px;padding:0;padding-bottom:16px;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$pro['quantity'] * $pro['product_price'].'</td>
              ';
              $messagevendor.= '</tr>
            ';
            }
            $messagevendor.= '
              </tbody>
            ';
            $messagevendor.='
          </table>
          ';
          $messagevendor.='
          <div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>
          ';
          
          $messagevendor.='
          <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:70px;">
            <tbody>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Sub Total</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Discount</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['discount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Tax</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['gst_amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Total</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['total_amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Payment Mode</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">'.$paymode['payment_name'].'</td>
              </tr>
            </tbody>
          </table>
        </th>
      </tr>
      <tr>
        <td bgcolor="#F8F7F0" style="padding:5px;"><table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;padding-bottom:24px;padding-left:32px;padding-right:32px;padding-top:24px;text-align:left;width:564px"> <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                    <tbody>
                      <tr style="padding:0;text-align:left;vertical-align:top">
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <p style="font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left"> <img src="https://www.creaseart.com/images/location.png" style="clear:both;display:inline-block;height:13px;margin-right:0px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="location.png"> <span style="display:inline-block;font-size:14px;font-weight:600;vertical-align:middle;width:144px">Delivery Address:</span> <span style="display:inline-block;font-size:13px;font-weight:500;vertical-align:top"> '.$useremail['name'].' | '.$datas['user_address'].'</span> </p>
                        </th>
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0"></th>
                      </tr>
                    </tbody>
                  </table>
                </th>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#F8F7F0" style="padding:5px;"><table cellpadding="0" cellspacing="0" width="100%%">
            <tr>
              <td align="center"><table cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding:5px;"><a href="https://www.facebook.com/creaseartapp" target="_blank"> <img src="https://www.creaseart.com/images/facebook.png" alt="Facebook" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://twitter.com/ArtCrease" target="_blank"> <img src="https://www.creaseart.com/images/twitter.png" alt="twitter" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.instagram.com/creaseartapp/" target="_blank"> <img src="https://www.creaseart.com/images/instagram.png" alt="instagram" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.youtube.com/channel/UCTwVa9gPwKbpKfG0gHTAkJA" target="_blank"> <img src="https://www.creaseart.com/images/youtube.png" alt="youtube" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.linkedin.com/in/crease-art-97a2a7174/" target="_blank"> <img src="https://www.creaseart.com/images/linkedin.png" alt="linkedin" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="tel:+91 810 202 0271" target="_blank"> <img src="https://www.creaseart.com/images/call.png" alt="linkedin" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="mailto:info@creaseart.com" target="_blank"> <img src="https://www.creaseart.com/images/email.png" alt="linkedin" style="display: block;"/> </a></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
    </table>
      </td>
  </tr>
</table>
';
$messageadmin.= '
<table align="center" cellpadding="0" cellspacing="0" width="95%%">
  <tr>
    <table align="center"  cellpadding="0" cellspacing="0" width="600" style="border-collapse: separate; border-spacing: 2px 5px; box-shadow: 1px 0 1px 1px #B8B8B8;" bgcolor="#F6EFE6">
      <tr>
        <td align="center" style="padding: 5px 5px 5px 5px;"><a href="#" target="_blank"> <a href="https://www.creaseart.com/" target="_blank"> <img src="https://www.creaseart.com//template/default/images/logo.png" alt="Creaseart" style="width:80px;border:0;"/> </a></td>
      </tr>
      <tr>
        <td align="center"><!-- Initial relevant banner image goes here under src-->
          
          <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%; border-radius: 6px; background:#fcfcfc"">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:10px;text-align:left;width:564px"> <table style="border-collapse:collapse;;padding:0;text-align:left;vertical-align:top;width:100%;">
                    <tbody>
                      <tr style="padding:0;text-align:left;vertical-align:top">
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <h6  style="margin:0;;color:inherit;font-family:sans-serif;font-size:18px;font-weight:400;line-height:1.3;padding:0;text-align:left;word-wrap:normal">Hi Admin, </h6>
                          <p style="margin:0;;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:normal;margin-top:12px;padding:0;text-align:left">A New Order Placed On Creaseart APP. Order details are given below.</p>
                        </th>
                        <th  style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0"> </th>
                      </tr>
                    </tbody>
                  </table>
                </th>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr style="padding:0;text-align:left;vertical-align:top">
        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <p style="margin:0;color:#333;font-family:sans-serif;font-size:17px;font-weight:600;line-height:1.4;margin-top:5px;padding:0;text-align:left; margin-left:20px;">'.$vendorname['company_name'].'</p>
          <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;line-height:1.4;margin-top:8px;padding:0;text-align:left; margin-left:20px;">Order Id: '.$orderid.'</p>
          <p  style="color:#666;font-family:sans-serif;font-size:13px;font-weight:600;margin-top:1px;padding:0;text-align:left; margin-left:20px;">Order Date: '.$datas['date_added'].'</p>
          <div style="border-top:1px solid #FCFCFC;margin-bottom:5px;margin-top:16px"></div>
          <p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;"> <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png"> <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Pickup Time - </span> <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['pickup_date'].' | '.$datas['pickup_time'].'</span> </p>
          <p style="margin:0;margin-bottom:0;color:#666;font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left; margin-left:17px;"> <img src="https://www.creaseart.com/images/clock.png" style="clear:both;display:inline-block;height:15px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="Clock.png"> <span style="color:#666;display:inline-block;font-size:14px;font-weight:600;text-transform:capital;vertical-align:middle;width:100px;">Delivery Time - </span> <span style="color:#333;display:inline-block;font-size:14px;font-weight:600;vertical-align:middle">'.$datas['deliver_date'].' | '.$datas['deliver_time'].'</span> </p>
          <div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>
          <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:15px;">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:left;width:50%">ITEMS</th>
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">PRICE</th>
                <th style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:14%">QTY</th>
                <th  style="margin:0;color:#333;font-family:sans-serif;font-size:13px;font-weight:600;padding-bottom:16px;text-align:center;width:18%">TOTAL</th>
              </tr>
            ';
            
            
            foreach($params['product_detail'] as $key=>$pro){
            $product = $this->showAllProductbyid($pro['product_id']);
            $catname1 = $this->GetCategoryName($product['category_id']);
            $catname2 = $this->GetCategoryName($product['subcat_id']);
            $messageadmin.= '
            <tr style="padding:0;text-align:left;vertical-align:top">
              <td style="font-family:sans-serif;font-size:13px;text-align:left;vertical-align:top;word-wrap:break-word">'.$catname1['catname'].' | '. $product['pname'].' ('.$catname2['catname'].')</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">₹ '.$pro['product_price'].'</td>
              <td style="font-family:sans-serif;font-size:13px;text-align:center;vertical-align:top;">'.$pro['quantity'].'</td>
              <td style="font-family:sans-serif;font-size:13px;padding:0;padding-bottom:16px;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$pro['quantity'] * $pro['product_price'].'</td>
              ';
              $messageadmin.= '</tr>
            ';
            }
            $messageadmin.= '
              </tbody>
            ';
            $messageadmin.='
          </table>
          ';
          $messageadmin.='
          <div style="border-top:1px solid #FCFCFC;margin-bottom:16px;margin-top:10px"></div>
          ';
          
          $messageadmin.='
          <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%; margin-left:70px;">
            <tbody>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Sub Total</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Discount</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['discount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Tax</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['gst_amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Total</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">₹'.$datas['total_amount'].'</td>
              </tr>
              <tr style="padding:10px;text-align:left;vertical-align:top">
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">Payment Mode</td>
                <td style="font-family:sans-serif;font-size:15px;font-weight:600;line-height:35px;padding:0;text-align:center;vertical-align:top;word-wrap:break-word">'.$paymode['payment_name'].'</td>
              </tr>
            </tbody>
          </table>
        </th>
      </tr>
      <tr>
        <td bgcolor="#F8F7F0" style="padding:5px;"><table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <th style="margin:0 auto;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;padding-bottom:24px;padding-left:32px;padding-right:32px;padding-top:24px;text-align:left;width:564px"> <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                    <tbody>
                      <tr style="padding:0;text-align:left;vertical-align:top">
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0;text-align:left"> <p style="font-family:sans-serif;font-size:13px;font-weight:400;line-height:1.4;margin-top:0;padding:0;text-align:left"> <img src="https://www.creaseart.com/images/location.png" style="clear:both;display:inline-block;height:13px;margin-right:0px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:auto" alt="location.png"> <span style="display:inline-block;font-size:14px;font-weight:600;vertical-align:middle;width:144px">Delivery Address:</span> <span style="display:inline-block;font-size:13px;font-weight:500;vertical-align:top"> '.$useremail['name'].' | '.$datas['user_address'].'</span> </p>
                        </th>
                        <th style="margin:0;color:#0a0a0a;font-family:sans-serif;font-size:16px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;width:0"></th>
                      </tr>
                    </tbody>
                  </table>
                </th>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td bgcolor="#F8F7F0" style="padding:5px;"><table cellpadding="0" cellspacing="0" width="100%%">
            <tr>
              <td align="center"><table cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding:5px;"><a href="https://www.facebook.com/creaseartapp" target="_blank"> <img src="https://www.creaseart.com/images/facebook.png" alt="Facebook" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://twitter.com/ArtCrease" target="_blank"> <img src="https://www.creaseart.com/images/twitter.png" alt="twitter" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.instagram.com/creaseartapp/" target="_blank"> <img src="https://www.creaseart.com/images/instagram.png" alt="instagram" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.youtube.com/channel/UCTwVa9gPwKbpKfG0gHTAkJA" target="_blank"> <img src="https://www.creaseart.com/images/youtube.png" alt="youtube" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="https://www.linkedin.com/in/crease-art-97a2a7174/" target="_blank"> <img src="https://www.creaseart.com/images/linkedin.png" alt="linkedin" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="tel:+91 810 202 0271" target="_blank"> <img src="https://www.creaseart.com/images/call.png" alt="linkedin" style="display: block;"/> </a></td>
                    <td style="padding:5px;"><a href="mailto:info@creaseart.com" target="_blank"> <img src="https://www.creaseart.com/images/email.png" alt="linkedin" style="display: block;"/> </a></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
    </table>
      </td>
  </tr>
</table>';
		                $ok = @mail($to1 , $subjectuser, $messageuser, $headers); 
						$ok1 = @mail($to2 , $subjectvendor, $messagevendor, $headers); 
						$ok3 = @mail($to3 , $subjectadmin, $messageadmin, $headers); 
						
					
	}
	
	return $data;
						
					

	}
	


	
	    function AssignOrdertoRider($datas)
        {
			$vendorid = $this->CheckOrderStatusByid($datas["order_id"]);
		$datas["orderid"] = $datas["order_id"]; 
		$datas["order_ids"] = $datas["order_id"]; 
		$datas["vendors_id"] = $vendorid["vendor_id"];
		$datas["users_id"] = $vendorid["usid"];
		 $data = $this->dbcon->Insert('itf_assign_rider',$datas);
		 	$statusid = $this->dbcon->Insert('itf_app_order_status',$datas);
		return $data;            
	     }
		 
		  function CheckAssignRider($riderid, $order_id, $status_id)
	{
      //$sql="select * from itf_assign_rider where rider_id='".$riderid."' and orderid='".$order_id."'";	  
		//return $this->dbcon->Query($sql);	
		
		$sql="select U.*,U.id as stat_id,P.* from itf_app_order_status U
          LEFT JOIN itf_assign_rider P on U.order_ids = P.orderid 
          where U.order_ids='".$order_id."' and U.rider_id='".$riderid."'  and U.status_id='".$status_id."'";	  
	  return $this->dbcon->Query($sql);	
	
	}
	
	
	function getTotalOrderlistByVendorId($vendor_id)
	{
		//echo $sql = "select * from itf_order order by id desc";
$sql="SELECT count(*) FROM itf_order where vendor_id='".$vendor_id."'";
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
		function getTotalPricelistByVendorId($vendor_id)
	{
		//echo $sql = "select * from itf_order order by id desc";
$sql="SELECT SUM(total_amount) FROM itf_order where vendor_id='".$vendor_id."'";
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
	function getOrderlistByVendorId($vendor_id)
	{
		//echo $sql = "select * from itf_order order by id desc";
$sql="select O.*,O.id as order_id, R.orderid, R.rider_id from itf_order O
		LEFT JOIN itf_assign_rider R on O.id = R.orderid where O.vendor_id='".$vendor_id."' order by id asc";
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
	
	function getOrderlistByAdmin()
	{
		//echo $sql = "select * from itf_order order by id desc";
 $sql="select O.*,O.id as order_id, R.orderid, R.rider_id from itf_order O
		LEFT JOIN itf_assign_rider R on O.id = R.orderid order by id asc";
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	
	 function getOrderDetailsAdminById($id)
	{
$sql="select P.*, O.*,O.id as order_id, O.vendor_id as vendorid, R.orderid, R.rider_id, S.status_id, S.order_ids from itf_user_profile P
          LEFT JOIN itf_order O on P.id = O.vendor_id
		  LEFT JOIN itf_assign_rider R on O.id = R.orderid
		    LEFT JOIN itf_app_order_status S on O.id = S.order_ids
          where O.id='".$id."'";	  
	$datas = $this->dbcon->FetchAllResults($sql);
	
	return $datas;
	}
	
	function ShowAllOrderCustomerSearchOrder($phone)
    {
       
	$sql="select U.id as user_id,U.*, P.* from itf_users U
              LEFT JOIN itf_user_profile P ON U.profile_id = P.id where U.usertype=2 and P.email_phone='".$phone."'";
      		return $this->dbcon->FetchAllResults($sql);

    }
	
	
	function ShowAllOrderSearchByVendorid($txtsearch,$vendor_id)
	{
		
		$ord = $this->ShowAllOrderCustomerSearchOrder($txtsearch);
	
             $order1="";
			 
           if($vendor_id){
                $order1= "and O.vendor_id='".$vendor_id."'";
            }
			
			if($txtsearch){
            $where="";
			
			if(isset($ord[0]['profile_id'])and $ord[0]['profile_id'] !=null){
			
			 $where= "and O.usid='".$this->dbcon->EscapeString($ord[0]['profile_id'])."'";
			}
             else {
                
                $where = "and O.id='".$this->dbcon->EscapeString($txtsearch)."'";
            }}
			
      $sql="select O.*,O.id as order_id, R.orderid, R.rider_id from itf_order O
		LEFT JOIN itf_assign_rider R on O.id = R.orderid where status=1 ".$where." ".$order1."";
           
		//echo $sql="select U.* from itf_users U where  U.usertype=4 ".$where1." ".$where." ".$order1 ;
		return $this->dbcon->FetchAllResults($sql);
	}
	
	
}


/*$oldarr = $datas['product_id'];
$string_text = $oldarr[0];
$new_array = explode(',',$string_text);


$oldarr1 = $datas['quantity'];
$string_text1 = $oldarr1[0];
$new_array1 = explode(',',$string_text1);


$oldarr2 = $datas['product_price'];
$string_text2 = $oldarr2[0];
$new_array2 = explode(',',$string_text2);

print_r($datas['product_id']);
			foreach($new_array as $key=>$quote)
			{				
				$info = array("order_id"=>$orderid,"product_id"=>$quote,"quantity"=>$new_array1[$key],"product_price"=>$new_array2[$key]);
				
				$this->dbcon->Insert('itf_order_items',$info);
			}
			
			
			
			
			*/
			
			
		/*		foreach($datas['product_id'] as $row=>$act){
					
			  $datas['product_id']= mysql_real_escape_string($act); 
               
            $datas['quantity']= $datas['quantity'][$row];
          $datas['product_price'] = mysql_real_escape_string($datas['product_price'][$row]);



				  $datas["order_id"] = $orderid;
			 print_r($datas);
				  
				  
			$this->dbcon->Insert('itf_order_items',$datas);
			
				}*/
?>