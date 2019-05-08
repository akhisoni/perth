<?php
class Site 
{
	public $dbcon;
	function __construct()
	{
		global $itfmysql;
		$this->dbcon=$itfmysql;
	}

	
	function admin_update()
	{
		$datas=$_REQUEST;
		$condition = array('id'=>$datas['id']);
		unset($datas['id']);
		$this->dbcon->Modify('itf_siteinfo',$datas,$condition);
	}


	function CheckSite($Id)
	{
		$sql="select * from itf_siteinfo where id='".$Id."'";
	 	return $this->dbcon->Query($sql);
	}

    function getCountries()
    {
        $sql="select * from itf_country order by country_name ";
        return $this->dbcon->FetchAllResults($sql);
    }

    
    
    function getHomePageDataSection($id)
    {
     $sql="select * from itf_home_page where id='".$id."'";
        return $this->dbcon->Query($sql);
    }
    
    
    
    function Home_Page_Update_Section($datas){
  
	   

         if(isset($_FILES['b_image']['name']) and !empty($_FILES['b_image']['name']))
		{
			$fimgname="b_image".time();
			$objimage= new ITFImageResize();
			$objimage->load($_FILES['b_image']['tmp_name']);
			$objimage->save(PUBLICFILE."home_about_banner/".$fimgname);
			$productimagename=$objimage->createnames;
			$datas['b_image']	=	$productimagename;
			$advertiseinfo=$this->getHomePageDataSection($datas['id']);
			@unlink(PUBLICFILE."home_about_banner/".$advertiseinfo["b_image"]);
		}
        
        $condition = array('id'=>$datas['id']);
        unset($datas['id']);
        $this->dbcon->Modify('itf_home_page',$datas,$condition);
     
    }

}
?>