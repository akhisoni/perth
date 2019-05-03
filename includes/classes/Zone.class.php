<?php

class Zone 

{

	

	function __construct()

	{

		global $itfmysql;

		$this->dbcon=$itfmysql;

	}

	

	function Get_Zone($id)

	{

		$sql="select * from itf_zone where id='".$id."'";

		return $this->dbcon->Query($sql);

	}

	

	function admin_addZone($datas)

	{
$datas["slug"]=empty($datas["slug"])?Html::seoUrl($datas["zonename"]):Html::seoUrl($datas["slug"]);
        if(!empty($_FILES['image']['name'])){

            if(isset($datas['id'])){

                $imagenames = $this->upload($datas['id']);

            } else{

                $imagenames = $this->upload();

            }

            $datas['image'] = $imagenames['image'];

        }

		unset($datas['id']);

		return $this->dbcon->Insert('itf_zone',$datas);



	}





    function upload($id)

    {



        if(isset($id) and !empty($id))

        {

            $info = $this->CheckZone($id);

            if(!empty($_FILES['image']['name'])){

                @unlink(PUBLICFILE."categories/".$info['image']);

            }



        }

        if(isset($_FILES['image']['name']) and !empty($_FILES['image']['name']))

        {

            $fimgname="plucka_".rand();

            $objimage= new ITFImageResize();

            $objimage->load($_FILES['image']['tmp_name']);

            $objimage->save(PUBLICFILE."categories/".$fimgname);

            $productimagename = $objimage->createnames;



            $datas['image'] = $productimagename;

        }



        return $datas;

    }





	function admin_updateZone($datas)

	{

        $imagenames = $this->upload($datas['id']);

        if(!empty($_FILES['image']['name'])){

            $datas['image'] = $imagenames['image'];

        }

		$condition = array('id'=>$datas['id']);
		$datas["slug"]=empty($datas["slug"])?Html::seoUrl($datas["zonename"]):Html::seoUrl($datas["slug"]);

		unset($datas['id']);

		return $this->dbcon->Modify('itf_zone',$datas,$condition);

	}



	



	function cat_deleteAdmin($id)

	{

        if(isset($id) and !empty($id))

        {

            $info = $this->CheckZone($id);

            if(!empty($_FILES['image']['name'])){

                @unlink(PUBLICFILE."categories/".$info['image']);

            }



        }

        $sql="delete from itf_zone where id in(".$id.")";

		$this->dbcon->Query($sql);



		return $this->dbcon->querycounter;

	}

	

	function cat_deleteSeller($id)

	{

        if(isset($id) and !empty($id))

        {

            $info = $this->CheckZoneSeller($id);

            if(!empty($_FILES['image']['name'])){

                @unlink(PUBLICFILE."categories/".$info['image']);

            }



        }

        $sql="delete from itf_zone where id in(".$id.") and seller_id='".$_SESSION['FRONTUSER']['id']."'"; 

		$this->dbcon->Query($sql);



		return $this->dbcon->querycounter;

	}

	

	

	

	

	function showAllZone()

	{

		$sql="select *  from itf_zone where status='1' order by zonename";



		return $this->dbcon->FetchAllResults($sql);

	}

	





	function ShowAllZoneSearch($txtsearch)

	{

		$sql="select * from itf_zone where  name like ( '%".$this->dbcon->EscapeString($txtsearch)."%')";

		return $this->dbcon->FetchAllResults($sql);

	}

	

	function CheckZone($UsId)

	{

		$sql="select U.* from itf_zone U where U.id='".$UsId."'";

	 	return $this->dbcon->Query($sql);

	}

		function CheckZoneSeller($UsId)

	{

		$sql="select U.* from itf_zone U where U.id='".$UsId."' and seller_id='".$_SESSION['FRONTUSER']['id']."' ";

	 	return $this->dbcon->Query($sql);

	}



    function CheckZoneByName($cat_name ,$parent = 0)

    {

        $sql="select C.* from itf_zone C where C.zonename = '".$this->dbcon->EscapeString($cat_name)."' and C.parent = '".$parent."'";

        return $this->dbcon->Query($sql);

    }

			

	

	//Function for change status	

	function PublishBlock($ids)

	{	



		$infos=$this->CheckZone($ids);

		if($infos['status']=='1')

			$datas=array('status'=>'0');

		else

			$datas=array('status'=>'1');

		

		$condition = array('id'=>$ids);

		$this->dbcon->Modify('itf_zone',$datas,$condition);

		

		return ($infos['status']=='1')?"0":"1";



	}



	//front end============================================================
     
	 
//	  function getAllZoneFrontlist($parent)
//
//    {
//
//        $sql="select *  from itf_zone where parent ='".$parent."' and status='1' order by zonename";
//
//        $res = $this->dbcon->FetchAllResults($sql);
//
//	}


    function getAllZoneFront($parent=0,$limit=10000)

    {

        $sql="select *  from itf_zone where parent ='".$parent."' and status='1' order by zonename limit ".$limit." ";

        $res = $this->dbcon->FetchAllResults($sql);



        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategories($r['id']);

                $r["subcat"] = $re;



            }

        }

        return $res;

    }



    // Get All categories and subcategories



    function getCategories($parent=0)
    {
        $sql="select *  from itf_zone where parent ='".$parent."' and status=1 order by zonename";
        $res = $this->dbcon->FetchAllResults($sql);



        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategories($r['id']);

                $r["subcat"] = $re;



            }

        }

            return $res;



    }



    function getCategoriesAjaxloader($position,$item_per_page)
    {
        $sql="select *  from itf_zone where parent ='0' and status=1 ORDER BY zonename ASC LIMIT $position, $item_per_page ";
        $res = $this->dbcon->FetchAllResults($sql);
        if(count($res) > 0){
            foreach($res as &$r)
            {
                $re = $this->getCategories($r['id']);
                $r["subcat"] = $re;



            }

        }

            return $res;



    }

	 function getCategoriesAdmin($parent=0)

    {

       $sql="select *  from itf_zone where parent ='".$parent."' order by zonename";

        $res = $this->dbcon->FetchAllResults($sql);



        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategoriesAdmin($r['id']);

                $r["subcat"] = $re;



            }

        }

            return $res;



    }

	

	 function getCategoriesSeller($parent=0)

    {

        $sql="select *  from itf_zone where  seller_id = '".$_SESSION['FRONTUSER']['id']."' order by zonename ";

        $res = $this->dbcon->FetchAllResults($sql);

    // echo "<pre>"; print_r($res);

      //  if(count($res) > 0){

//            xforeach($res as &$r)

//            {

//                $re = $this->getCategoriesSeller($r['id']);

//                $r["subcat"] = $re;

//

//            }

//        }

            return $res;



    }

    

    function getSupCategories()

    {

        $sql="select *  from itf_zone where  status='1' order by zonename";

        $res = $this->dbcon->FetchAllResults($sql);



        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategories($r['id']);

                $r["subcat"] = $re;



            }

        }

            return $res;



    }



    function getBreadcum($catid=0,$level=0){

        $res = $this->CheckZone($catid);

        if(isset($res['id']) and $level == 0){

            return $this->getBreadcum($res['parent'],$level+1)."/ ".$res['zonename'];

        }elseif(isset($res['id'])){

            return $this->getBreadcum($res['parent'],$level+1).'/ <a href="'.CreateLink(array('product','id'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }else{



            return "";

        }

    }



    function getBreadcumProduct($catid=0,$level=0){

        $res = $this->CheckZone($catid);

        if(isset($res['id']) and $level == 0){

            return $this->getBreadcum($res['parent'],$level+1).'/ <a href="'.CreateLink(array('product','id'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }elseif(isset($res['id'])){

            return $this->getBreadcum($res['parent'],$level+1).'/ <a href="'.CreateLink(array('product','parent'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }else{



            return "";

        }

    }



    

    function getQuoteProductParentHierarchy($catid=0,$level=0){

        $res = $this->CheckZone($catid);

        if(isset($res['id']) and $level == 0){

            return $this->getParentHierarchy($res['parent'],$level+1).'> <a href="'.CreateLink(array('product','itemid'=>'catdetail','id'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }elseif(isset($res['id'])){

            return $this->getParentHierarchy($res['parent'],$level+1).'> <a href="'.CreateLink(array('product','parent'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }else{



            return "";

        }

    }



     function getParentHierarchy($catid=0,$level=0){

        $res = $this->CheckZone($catid);

        if(isset($res['id']) and $level == 0){

            return $this->getParentHierarchy($res['parent'],$level+1)."> ".$res['zonename'];

        }elseif(isset($res['id'])){

            return $this->getParentHierarchy($res['parent'],$level+1).'> <a href="'.CreateLink(array('product','parent'=>$res['id'])).'">'.$res["zonename"].'</a> ';

        }else{



            return "";

        }

    }

    

    

    

    

    function  getAllCategories()

    {

        $sql="select *  from itf_zone where status='1' order by id desc limit 32 ";



        return $this->dbcon->FetchAllResults($sql);

    }



    function showCategoriesList($parent=0)

    {

        $categories = $this->getCategories($parent);

        $catlist = array();

        foreach($categories as $key=>$category)

        {

            $catlist[$category["id"]] = $category["zonename"];

            if(count($category["subcat"]) > 0){

                foreach($category["subcat"] as $subcat)

                {

                    $catlist[$subcat["id"]] = $category["zonename"].">>".$subcat["zonename"];

                    if(count($subcat["subcat"]) > 0){

                        foreach($subcat["subcat"] as $subsubcat)

                        {
							
                            $catlist[$subsubcat["id"]] = $category["zonename"].">>".$subcat["zonename"].">>".$subsubcat["zonename"];

                        }

                    }

                }



            }

        }



        return $catlist;

    }



    function showCategoriesListFront($parent=0)

    {

        $categories = $this->getCategories($parent);

        $catlist = array();

        foreach($categories as $key=>$category)

        {

            $catlist[] = array("id"=>$category["id"],"zonename"=>$category["zonename"],"status"=>$category["status"]);

            if(count($category["subcat"]) > 0){

                foreach($category["subcat"] as $subcat)

                {

                    $catlist[] = array("id"=>$subcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"],"status"=>$subcat["status"]);

                    if(count($subcat["subcat"]) > 0){

                        foreach($subcat["subcat"] as $subsubcat)

                        {

                            $catlist[] = array("id"=>$subsubcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"].">>".$subsubcat["zonename"],"status"=>$subsubcat["status"]);

                        }

                    }

                }



            }

        }



        return $catlist;

    }







 function showCategoriesListAdmin($parent=0)

    {

        $categories = $this->getCategoriesAdmin($parent);

        $catlist = array();

        foreach($categories as $key=>$category)

        {

            $catlist[] = array("id"=>$category["id"],"zonename"=>$category["zonename"],"status"=>$category["status"]);

            if(count($category["subcat"]) > 0){

                foreach($category["subcat"] as $subcat)

                {

                    $catlist[] = array("id"=>$subcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"],"status"=>$subcat["status"]);

                    if(count($subcat["subcat"]) > 0){

                        foreach($subcat["subcat"] as $subsubcat)

                        {

                            $catlist[] = array("id"=>$subsubcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"].">>".$subsubcat["zonename"],"status"=>$subsubcat["status"]);

                        }

                    }

                }



            }

        }



        return $catlist;

    }







 function showCategoriesListSeller($parent=0)

    {

        $categories = $this->getCategoriesSeller($parent);

        $catlist = array();

        foreach($categories as $key=>$category)

        {

            $catlist[] = array("id"=>$category["id"],"zonename"=>$category["zonename"],"status"=>$category["status"]);

            if(count($category["subcat"]) > 0){

                foreach($category["subcat"] as $subcat)

                {

                    $catlist[] = array("id"=>$subcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"],"status"=>$subcat["status"]);

                    if(count($subcat["subcat"]) > 0){

                        foreach($subcat["subcat"] as $subsubcat)

                        {

                            $catlist[] = array("id"=>$subsubcat["id"],"zonename"=>$category["zonename"].">>".$subcat["zonename"].">>".$subsubcat["zonename"],"status"=>$subsubcat["status"]);

                        }

                    }

                }



            }

        }



        return $catlist;

    }









    function showCountProduct($id)

    {

        $sql="select *  from itf_product where category_id ='".$id."' and status='1'";

        $res = $this->dbcon->FetchAllResults($sql);



        return count($res);

    }

	

	

    function getSortByZone($catid,$sort = 'id')

    {

        if($sort == 'id'){

            $order_by = 'where P.parent=0 order by P.'.$sort.' desc';

        }else{

            $order_by = 'where P.parent=0 order by P.'.$sort.' asc';

        }



       $sql="select P.* from itf_zone P  ".$order_by ;



        $res= $this->dbcon->FetchAllResults($sql);

	        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategories($r['id']);

                $r["subcat"] = $re;



            }

        }

            return $res;

		

		

    }

	

    function getSortBySubZone($catid,$sort = 'id')

    {

        if($sort == 'id'){

            $order_by = 'where P.parent='.$catid.'  order by P.'.$sort.' desc';

        }else{

            $order_by = 'where P.parent='.$catid.' order by P.'.$sort.' asc';

        }



      $sql="select P.* from itf_zone P  ".$order_by ;



        $res= $this->dbcon->FetchAllResults($sql);

	        if(count($res) > 0){

            foreach($res as &$r)

            {

                $re = $this->getCategories($r['id']);

                $r["subcat"] = $re;



            }

        }

            return $res;

		

		

    }


	function getAllActiveCat($parentid=0) {
	
		$sql="select *  from itf_zone where parent='".$parentid."' and status=1 order by id ASC";
		return $this->dbcon->FetchAllResults($sql);
	
	} 
	
		function getAllActiveSubCat($parentid) {
	
		$sql="select *  from itf_zone where parent='".$parentid."' and status=1 order by zonename ASC";
		return $this->dbcon->FetchAllResults($sql);
	
	} 
	function getCatNameValue($ids){
	
		$sql="select id,zonename from itf_zone where id='".$ids."'";

		return $this->dbcon->Query($sql);
	
	
	}
		
		

		
		
		
}

?>