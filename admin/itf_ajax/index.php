<?php 
$msgs="Login";
require('../../itfconfig.php');
$ojbuser=new User();
if(isset($_REQUEST['itfpg']) and $_REQUEST['itfpg']=="uservalidate")
{
	if($ojbuser->userUniqueByUsername($_REQUEST['username'])=="1")
	echo 'false';
	else
	echo 'true';
}
elseif(isset($_REQUEST['email']) and $_REQUEST['email']=="emailvalue")
{
	if($ojbuser->CheckEmailId($_REQUEST['email']))
	echo 'false';
	else
	echo 'true';
}
elseif(isset($_POST['itfpg']) and !empty($_POST['itfpg']))
{
	if($_POST['itfpg']=="userlist" or $_POST['itfpg']=="userlistagent")
	{
		echo $ojbuser->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="frmpages")
	{
		$objCMS = new PageCms();
		echo $objCMS->PublishBlock($_POST['flid']);
	}
	elseif($_POST['itfpg']=="cmspage")
	{
		$objCMS = new PageCms();
		echo $objCMS->PublishBlock($_POST['flid']);
	}
    elseif($_POST['itfpg']=="product")
    {
        $obj = new Product();
        echo $obj->PublishBlock($_POST['flid']);
    }
	 elseif($_POST['itfpg']=="product_feature")
    {
        $obj = new Product();
        echo $obj->PublishFeatureBlock($_POST['flid']);
    }
    elseif($_POST['itfpg']=="quote")
    {
        $obj = new Quote();
        echo $obj->PublishBlock($_POST['flid']);
    }
     elseif($_POST['itfpg']=="newsletter")
    {
        $obj = new Newsletter();
        echo $obj->PublishSubscriber($_POST['flid']);
    }
    elseif($_POST['itfpg']=="user")
    {
        $obj = new User();
        echo $obj->PublishBlock($_POST['flid']);
    }
    
      elseif($_POST['itfpg']=="member")
    {
        $obj = new User();
        echo $obj->PublishMember($_POST['flid']);
    }
	elseif($_POST['itfpg']=="frmcategory")
	{
		$objCAT = new Category();
		echo $objCAT->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="frmenquiry")
	{
		$objreport = new Report();
		echo $objreport->PublishBlock($_POST['flid']);
	}

	elseif($_POST['itfpg']=="frmadvertise")
	{
		$objactions = new Advertise();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	elseif($_POST['itfpg']=="frmtestimonial")
	{
		$objtesti = new Testimonial();
		echo $objtesti->PublishBlock($_POST['flid']);
	}
	elseif($_POST['itfpg']=="frmbanner")
	{
		$objbanner = new Banner();
		echo $objbanner->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="adminuserlist")
	{
		$objAdminUser = new AdminUser();
		echo $objAdminUser->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="frmbusiness")
	{
		$objactions = new Business();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="frmfaculty")
	{
		$objactions = new Faculty();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="packagelist")
	{
		$objactions = new Package();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="zonelist")
	{
		$objactions = new Zone();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
		elseif($_POST['itfpg']=="moderator")
	{
		$objactions = new User();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
	elseif($_POST['itfpg']=="moddiscount")
	{
		$objactions = new Discount();
		echo $objactions->PublishBlock($_POST['flid']);
	}
	
	
	elseif($_POST['itfpg']=="frmbanner1")
	{
		$objactions = new WebsiteBanner();
		echo $objactions->PublishBlock($_POST['flid']);
	}
    
    
	elseif($_POST['itfpg']=="eventst")
	{
		$objactions = new Events();
		echo $objactions->PublishBlock($_POST['flid']);
	}
    
     elseif($_POST['itfpg']=="eventfeature")
	{
		$objactions = new Events();
		echo $objactions->PublishFeatureBlock($_POST['flid']);
	}
    
    
	elseif($_POST['itfpg']=="newspage")
	{
		$objactions = new News();
		echo $objactions->PublishBlock($_POST['flid']);
	}
}

?>