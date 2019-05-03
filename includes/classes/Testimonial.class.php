<?php
class Testimonial 
{

	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}

	function admin_addTestimonial($datas)
	{
		if(isset($_FILES['bannerimage']['name']) and !empty($_FILES['bannerimage']['name']))
		{
			$fimgname="ITFADVER".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['bannerimage']['tmp_name']);
			$objimage->save(PUBLICFILE."testimonial/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['imagename']	=	$productimagename;
		}
		unset($datas['id']);
		$this->dbcon->Insert('itf_testimonials',$datas);
	}


	function admin_updateTestimonial($datas)
	{
		if(isset($_FILES['bannerimage']['name']) and !empty($_FILES['bannerimage']['name']))
		{
			$fimgname="ITFADVER".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['bannerimage']['tmp_name']);
			$objimage->save(PUBLICFILE."testimonial/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['imagename']	=	$productimagename;
			$advertiseinfo=$this->CheckTestimonial($datas['id']);
			@unlink(PUBLICFILE."testimonial/".$advertiseinfo["imagename"]);
		}
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_testimonials',$datas,$condition);
	}
	



	function Testimonial_deleteAdmin($Id)
	{
		//Delete all selected file

		$alladvertise=$this->GetTestimonialbyId($Id);

		foreach($alladvertise as $advertisedata)

		@unlink(PUBLICFILE."testimonial/".$advertisedata["imagename"]);

		

		$sql="delete from itf_testimonials where id in(".$Id.")";	

		$this->dbcon->Query($sql);

		return $this->dbcon->querycounter;

	}

	

	function showAllTestimonial()

	{

		$sql="select *  from itf_testimonials where 1=1 order by id DESC";

		return $this->dbcon->FetchAllResults($sql);

	}

        

        function showTestimonial()

	{

		$sql="select *  from itf_testimonials where status='1' order by id DESC";

		return $this->dbcon->Query($sql);

	}

	

	

	   function showTestimonialbyId($id)

	{

		$sql="select *  from itf_testimonials where status='1' and id ='".$id."'order by id DESC";

		return $this->dbcon->Query($sql);

	}

	

	   function showTestimonialbyFront()

	{

		$sql="select *  from itf_testimonials where status='1' order by id DESC";

				return $this->dbcon->FetchAllResults($sql);

	}


	

	

	

	function CheckTestimonial($UsId)

	{

		$sql="select U.* from itf_testimonials U where U.id='".$UsId."'";

	 	return $this->dbcon->Query($sql);

	}

			

	

	//Function for change status	

	function PublishBlock($ids)

	{	



		$infos=$this->CheckTestimonial($ids);

		if($infos['status']=='1')

			$datas=array('status'=>'0');

		else

			$datas=array('status'=>'1');

		

		$condition = array('id'=>$ids);

		$this->dbcon->Modify('itf_testimonials',$datas,$condition);

		

		return ($infos['status']=='1')?"0":"1";



	}

	

	function GetTestimonialbyId($Id)

	{

		$sql="select *  from itf_testimonials where id in(".$Id.")";

		return $this->dbcon->FetchAllResults($sql);

	}



	//front end============================================================

	function getAllTestimonialFront($possitionid="1",$adsnumber="5")

	{

		$sql="select *  from itf_testimonials where status='1' and placename='".$possitionid."' limit ".$adsnumber;

		return $this->dbcon->FetchAllResults($sql);

	}





}

?>