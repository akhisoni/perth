<?php
$objReport = new Product();
$currentpagenames=isset($_GET['itfpage'])?$_GET['itfpage']:'';
$pagetitle="Order List";

$actions=isset($_REQUEST['actions'])?$_REQUEST['actions']:'enquiry';
	switch($actions)
	{
        case 'add':
            include(ITFModulePath.'view/add.php');
            break;

        case 'list':
            include(ITFModulePath.'view/list.php');
            break;
			
		case 'edit':
		include(ITFModulePath.'view/add.php');
		break;
		
		case 'add':
		include(ITFModulePath.'view/add.php');
		break;


        case 'export':
            include(ITFModulePath.'view/export.php');
            break;

	
		default:
			include(ITFModulePath.'view/list.php');
	}
?>