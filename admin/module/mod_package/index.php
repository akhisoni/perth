<?php

$packageobj=new Package();
$currentpagenames=isset($_GET['itfpage'])?$_GET['itfpage']:'';
$pagetitle="Package";

$actions=isset($_REQUEST['actions'])?$_REQUEST['actions']:'cmss_list';
	switch($actions)
	{
		case 'add':
			include(ITFModulePath.'view/packages.php');
			break;
	
		case 'edit':
			include(ITFModulePath.'view/packages.php');
			break;
	
		case 'delete':
			include(ITFModulePath.'view/package_list.php');
			break;
	
		default:
			include(ITFModulePath.'view/package_list.php');
	}
?>