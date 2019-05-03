<?php
$obj = new User();
$currentpage = isset($_GET['itfpage'])?$_GET['itfpage']:'';
if(empty($_SESSION['FRONTUSER']))
{
    redirectUrl(CreateLink(array("signin","msg"=>'na')));
} else {
   
    if($_SESSION['FRONTUSER']['usertype'] == 3 || 4)
    {
        $actions = 'dashboard';
    } else {
        $actions = 'default';
    }
	
}

$page = BASEPATHS."/site/component/com_".$currentpage."/".$actions.".php";

if(file_exists($page))
   include_once($page);
else
   include_once(BASEPATHS.'/site/component/com_404/404.php');
	
?>




