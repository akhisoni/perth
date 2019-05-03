<?php
$objReport = new PageCms();
$currentpagenames=isset($_GET['itfpage'])?$_GET['itfpage']:'';
$pagetitle="Customer Enquiry";

$actions=isset($_REQUEST['actions'])?$_REQUEST['actions']:'enquiry';
	switch($actions)
	{
        case 'order':
            include(ITFModulePath.'view/enquiry.php');
            break;

        case 'clarification':
            include(ITFModulePath.'view/clarification.php');
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
			include(ITFModulePath.'view/enquiry.php');
	}
?>