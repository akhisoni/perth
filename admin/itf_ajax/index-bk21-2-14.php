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
elseif(isset($_REQUEST['emailid']) and $_REQUEST['emailid']=="emailvalue")
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
    elseif($_POST['itfpg']=="quote")
    {
        $obj = new Quote();
        echo $obj->PublishBlock($_POST['flid']);
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

	elseif($_POST['itfpg']=="frmadvertise")
	{
		$objactions = new Advertise();
		echo $objactions->PublishBlock($_POST['flid']);
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
	
	
	
	
}

?>